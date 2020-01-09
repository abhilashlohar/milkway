<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesVoucherRow extends Model
{
    protected $fillable = [
      'sales_voucher_id',  'qty','month_date'
     ];


    public static function boot()
    {
        parent::boot();
    }

    protected $casts = [
      'id' => 'string',
      'sales_voucher_id' => 'string',
      'product_id' => 'string',
      'qty' => 'string',
      'month_date' => 'date:Y-m-d',
    ];

    public static function rules($id = '') 
    {
      return [
          'sales_voucher_id' => 'required',
          'product_id' => 'required',
          'qty' => 'required',
      ];
    }

    public static function messages($id = '') 
    {
      return [
          'product_id.required' => 'You must enter product name.',
      ];
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function sales_voucher(){
      return $this->belongsTo(SalesVoucher::class);
    }

    public function product(){
      return $this->belongsTo(Product::class);
    }
}

