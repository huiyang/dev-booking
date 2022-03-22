<?php
namespace Addons\User\Http\Controllers\DataTable;

use App\Models\Payment;
use Fusion\Http\Controllers\DataTableController;

class UserPaymentController extends DataTableController {
    public function builder()
    {
        return Payment::query()->byUser(request()->user);
    }
  
    public function getDisplayableColumns()
    {
        return [
          'id',
          'status',
          'paymentMethodName',
          'displayTransactionId',
          'amount',
          'attachments',
          'created_at',
        ];
    }
  
    public function getFilterable()
    {
        return [
        ];
    }
  
    public function getSortable()
    {
        return [
            'id',
            'created_at',
        ];
    }
  
    public function getCustomColumnNames()
    {
        return [
            'created_at' => 'Uploaded Time',
        ];
    }
}