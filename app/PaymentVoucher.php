<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class PaymentVoucher extends Model
{
    protected $fillable = [
      'customer_id', 'amount', 'month_date'
     ];

    public static function boot()
    {
        parent::boot();
    }

    public static function rules($id = '') 
    {
      return [
          'customer_id' => 'required',
          'amount' => 'required',
          'month_date'       => 'required',
      ];
    }

    public static function messages($id = '') 
    {
      return [
          'customer_id.required' => 'You must enter customer name.',
          'amount.required' => 'You must enter amount.',
          'month_date.required' => 'You must enter date.'
      ];
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function customer(){
      return $this->belongsTo(Customer::class);
    }
}
