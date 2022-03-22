<?php
  namespace Ant\Member\Classes;

  use Vanilo\Checkout\Contracts\CheckoutDataFactory as CheckoutDataFactoryContract;
  use Vanilo\Contracts\Billpayer as BillpayerContract;
  use Vanilo\Contracts\Address as AddressContract;
  use App\Models\Billpayer;
  use App\Models\Address;

  class CheckoutDataFactory implements CheckoutDataFactoryContract
  {
    public function createBillpayer(): Billpayer{
      $billpayer = app(BillpayerContract::class);
      $address = app(AddressContract::class);

      $billpayer->address()->associate($address);

      return $billpayer;
    }

    public function createShippingAddress(): Address{
      $address = app(AddressContract::class);

      return $address;
    }
  }
