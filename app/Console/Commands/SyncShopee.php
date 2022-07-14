<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ant\Shopee\API\Item;

class SyncShopee extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopee:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $shopId = env('SHOPEE_SHOP_ID');

        // Step 1: authorize
        $response = app('shopee')->shop()->generateAuthorizationURL();
        dd($response);

        // $accessToken = '6c486f726f6d51466a41767473537752';
        // $response = app('shopee')->shop()->getInfo($shopId);
        // dd($response);
        

        // $response = app('shopee')->auth()->refreshToken(app('shopee')->auth()->accessToken($shopId));
        // $response = app('shopee')->auth()->accessToken($shopId);
        // dd($response);

        $itemId = 1794283;

        // $response = app('shopee')->product()->get_item_base_info($shopId, [
        //     'item_id_list' => $itemId,
        // ]);

        // dd($response);

        // $response = app('shopee')->product()->get_attributes($shopId, [
        //     'category_id' => 100777,
        // ]);

        // dd($response);

        // $response = app('shopee')->product()->get_item_list($shopId, [
        //     'offset' => 0,
        //     'page_size' => 20,
        //     'item_status' => "NORMAL",
        // ]);

        // dd($response);

        // $response = app('shopee')->product()->add_item($shopId, [
        //     "original_price" => 123.3,
        //     "description" => "item description test",
        //     "item_name" => "Item Name Example",
        //     "category_id" => 100777,
        //     "item_sku" => "test",

        //     "weight" => 1.1,
        //     "dimension" => [
        //         "package_height" => 11,
        //         "package_length" => 11,
        //         "package_width" => 11
        //     ],
        //     // "item_status" => "UNLIST",

        //     // "normal_stock" => 33,
        //     "logistic_info" => [
        //         [
        //             "size_id" => 0,
        //             "shipping_fee" => 23.12,
        //             "enabled" => true,
        //             "logistic_id" => 20020,
        //             "is_free" => false
        //         ]
        //     ],
        //     // "attribute_list" => [
        //     //     [
        //     //         "attribute_id" => 4990,
        //     //         "attribute_value_list" => [
        //     //             [
        //     //                 "value_id" => 32142,
        //     //                 "original_value_name" => "Brand",
        //     //                 "value_unit" => " kg"
        //     //             ]
        //     //         ]
        //     //     ]
        //     // ],
        //     "image" => [
        //         "image_id_list" => [
        //             'https://cf.shopee.com.my/file/e9db71a4e1b9dbb4a86b493a93d462f5'
        //         ]
        //     ],
        //     // "pre_order" => [
        //     //     "is_pre_order" => false,
        //     //     "days_to_ship" => 2
        //     // ],
        //     // "condition" => "NEW",
        //     // "wholesale" => [
        //     //     [
        //     //         "min_count" => 1,
        //     //         "max_count" => 100,
        //     //         "unit_price" => 28.3
        //     //     ]
        //     // ],
        //     // "video_upload_id" => "["sg_f4bde9bc-ff3c-485e-a6dd-3161dab4b942_000000"]",
        //     "brand" => [
        //         "brand_id" => 0
        //     ],
        //     "seller_stock" => [
        //         [
        //             "location_id" => "",
        //             "stock" => 0
        //         ]
        //     ]
        //     // "item_dangerous" => 0,
        //     // "tax_info" => [
        //     //     "ncm" => "",
        //     //     "same_state_cfop" => "",
        //     //     "diff_state_cfop" => "",
        //     //     "csosn" => "",
        //     //     "origin" => "",
        //     //     "cest" => "",
        //     //     "measure_unit" => "",
        //     //     "invoice_option" => "",
        //     //     "vat_rate" => "",
        //     //     "hs_code" => "",
        //     //     "tax_code" => ""
        //     // ],
        //     // "complaint_policy" => [
        //     //     "warranty_time" => "",
        //     //     "exclude_entrepreneur_warranty" => "",
        //     //     "complaint_address_id" => 0,
        //     //     "additional_information" => ""
        //     // ],
        //     // "description_info" => [
        //     //     "extended_description" => [
        //     //         "field_list" => [
        //     //             [
        //     //                 "field_type" => "",
        //     //                 "text" => "",
        //     //                 "image_info" => [
        //     //                     "image_id" => ""
        //     //                 ]
        //     //             ]
        //     //         ]
        //     //     ]
        //     // ],
        //     // "description_type" => "",
        // ]);
        // dd($response);


        // $client = new \Ant\Shopee\Client();
        // $response = $client->product->add_item([]);
        // dd($response);

        // app('shopee')->shop()->getInfo('56646');

        // dd(app('shopee')->logistics->getLogisticInfo());

        // dd(\Ant\Shopee\API\Logistics::list());
        
        dd(\Ant\Shopee\API\ShopCategory::list());

        // dd(Item::id(1794341)->getItemDetail());
        
        // dd(Item::list());

        // Item::id(1794341)->updateStock(11);
        // Item::id(1794341)->updatePrice(112);

        if (false) {
            $item = Item::find(1794341);
            $item->item_name = 'Updated product name';
            $item->item_sku = 'update-sku-item';
            // $item->package_height = 20;
            // $item->package_width = 20;
            // $item->package_length = 20;
            $item->save();
            // dd($item->name, $item->description);
        }
        if (false) {
            $categoryId = 100777;
            $data = Item::new('Test Book - Test Book5', 'Test description2 - Test description', 'dm1id-56175482-235', 11.2, $categoryId)
                // ->addAttribute(0, 'Darul Fikir')
                // ->addAttribute(100673, 'Chinese')
                ->setBrand(0)
                ->setStock(1)
                ->setDimension(0.2, 30, 23, 25)
                ->setShippingFee(20)
                ->addImages([
                    'https://cf.shopee.com.my/file/e9db71a4e1b9dbb4a86b493a93d462f5'
                ])
                ->add($shopId);

            dd($data); 
        }

        // $response = $client->item->getItemDetail([
            
        // ]);
        

        return 0;
    }
}
