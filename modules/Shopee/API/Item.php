<?php
namespace Ant\Shopee\API;

class Item {
    protected $itemId;
    protected $shopId;
    protected $properties = [];
    
    public function __construct($itemId = null, $shopId = null) {
        $this->itemId = $itemId;
        $this->shopId = $shopId ?? config('shopee.shop_id');
    }

    public function updateStock($stockQuantity) 
    {
        return $this->_(app('shopee')->product()->updateStock($this->shopId, [
            'item_id' => $this->itemId,
            'stock_list' => [
                [
                    'seller_stock' => [
                        [
                            'stock' => $stockQuantity,
                        ],
                    ]
                ]
            ]
        ]));
    }

    public function updatePrice($newPrice) {
        return $this->_(app('shopee')->product()->updatePrice($this->shopId, [
            'item_id' => $this->itemId,
            'price_list' => [
                [
                    'original_price' => $newPrice,
                ]
            ]
        ]));
    }

    public function save() {
        $updateAttributes = $this->properties;

        // foreach ($updateAttributes['attributes'] as &$attribute) {
        //     if (isset($attribute['attribute_id'])) {
        //         $attribute['attributes_id'] = $attribute['attribute_id'];
        //     }
        //     if (isset($attribute['attribute_id'])) {
        //         $attribute['value'] = $attribute['attribute_value'];
        //     }
        // }

        // if (isset($updateAttributes['logistics'])) {
        //     $updateAttributes['logistics'] = [
        //         [
        //             'logistic_id' => env('SHOPEE_DEFAULT_LOGISTICS_ID'),
        //             'enabled' => true,
        //         ],
        //     ];
        // }
        $updateAttributes['weight'] = (float) $updateAttributes['weight'];

        // unset($updateAttributes['images']);

        $data = $this->_(app('shopee')->product()->updateItem($this->shopId, $updateAttributes));
        
        $this->properties = $data['response'];
        return $data['response'];
    }

    public function getItemDetail()
    {
        $response = $this->_(app('shopee')->product()->getItemBaseInfo($this->shopId, [
            'item_id_list' => $this->itemId,
        ]));
        return $response['response']['item_list'][0] ?? null;
    }

    public function addImage($image)
    {
        $this->properties['image']['image_id_list'][] = $image;
        return $this;
    }

    public function addImages($images)
    {
        foreach($images as $image) {
            $this->addImage($image);
        }
        return $this;
    }

    public function addAttribute($attributeId, $value)
    {
        $this->properties['attributes'][] = [
            'attributes_id' => $attributeId,
            'value' => $value,
        ];
        return $this;
    }

    public function setDimension($weight, $length, $width, $height)
    {
        $this->properties['weight'] = $weight;
        $this->properties['dimension']['package_length'] = $length;
        $this->properties['dimension']['package_width'] = $width;
        $this->properties['dimension']['package_height'] = $height;

        return $this;
    }

    public function setBrand($brandId) 
    {
        $this->properties['brand']['brand_id'] = $brandId;
        return $this;
    }

    public function setStock($stockQuanity)
    {
        $this->properties['seller_stock'] = [
            [
                // "location_id" => "",
                "stock" => $stockQuanity,
            ]
        ];
        return $this;
    }

    public function setShippingFee($shippingFee, $logisticsId = null)
    {
        $this->properties['logistic_info'][] = [
            'logistic_id' => $logisticsId ?? (int) env('SHOPEE_DEFAULT_LOGISTICS_ID'),
            'shipping_fee' => $shippingFee,
            'enabled' => true,
        ];
        return $this;
    }

    public static function id($itemId)
    {
        return new static($itemId);
    }

    public static function find($itemId)
    {
        $item = new static($itemId);
        $data = $item->getItemDetail();
        $item->properties = $data;
        return $item;
    }

    public static function list($offset = 0, $limit = 20, $itemStatus = 'NORMAL', $shopId = null) {
        $shopId = $shopId ?? config('shopee.shop_id');
        return static::__(app('shopee')->product()->getItemList($shopId, [
            'offset' => $offset,
            'page_size' => $limit,
            'item_status' => $itemStatus,
        ]));
    }

    public static function make() {
        return new static();
    }

    public static function new($name, $description, $sku, $price, $categoryId) {
        $item = new static();
        $item->properties = array_merge($item->properties, [
            'item_name' => $name,
            'description' => $description,
            'original_price' => $price,
            'item_sku' => $sku,
            'category_id' => $categoryId,
        ]);
        return $item;
    }

    public static function fromArray($properties) {
        $item = new static();
        $item->properties = $properties;
        return $item;
    }

    public function add()
    {
        return $this->_(app('shopee')->product()->addItem($this->shopId, array_merge($this->properties, [
           
        ])));
    }

    protected function _($response) {
        return static::__($response);
    }

    protected static function __($response) {
        $data = $response;
        if (isset($data['error']) && $data['error']) {
            throw new \Exception($data['error'].': '.$data['message']);
        }
        return $data;
    }

    public function __get($name)
    {
        return $this->properties[$name] ?? null;
    }

    public function __set($name, $value)
    {
        return $this->properties[$name] = $value;
    }
}