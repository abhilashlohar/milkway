<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class SalesVoucher extends Model
{
    protected $fillable = [
      'voucher_no', 'customer_id', 'create_date', 'month','product_id'
     ];


    public static function boot()
    {
        parent::boot();
    }

    protected $casts = [
      'id' => 'string',
      'voucher_no' => 'string',
      'customer_id' => 'string',
      'month' => 'string',
      'create_date' => 'date:Y-m-d',
    ];

    public static function rules($id = '') 
    {
      return [
          'customer_id' => 'required',
          'create_date' => 'required',
          'month'       => 'required',
      ];
    }

    public static function messages($id = '') 
    {
      return [
          'customer_id.required' => 'You must enter customer name.',
          'create_date.required' => 'You must enter date.',
      ];
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function customer(){
      return $this->belongsTo(Customer::class);
    }

    public function SalesVoucherRow(){
      return $this->hasMany(SalesVoucherRow::class);
    }
}
