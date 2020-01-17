<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
     protected $fillable = [
      'firm_name', 'address'
     ];


    public static function boot()
    {
        parent::boot();
    }

    protected $casts = [
      'id' => 'string',
   ];

    public static function rules($id = '') 
    {
      return [
          'firm_name' => 'required',
          'address' => 'required',
      ];
    }

    public static function messages($id = '') 
    {
      return [
          'firm_name.required' => 'You must enter firm name.',
          'address.required' => 'You must enter address.',
      ];
    }

    public function getKeyType()
    {
        return 'string';
    }
}
