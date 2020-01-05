<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
      'name', 'unit_name', 'rate'
     ];


    public static function boot()
    {
        parent::boot();
        /*self::creating(function ($model) {
            $model->id = (string) Uuid::generate(4);
        });*/
    }

    protected $casts = [
      'id' => 'string',
   ];

    public static function rules($id = '') 
    {
      return [
          'name' => 'required',
          'unit_name' => 'required',
          'rate' => 'required',
      ];
    }

    public static function messages($id = '') 
    {
      return [
          'name.required' => 'You must enter name.',
          'unit_name.required' => 'You must enter unit name.',
          'rate.required' => 'You must enter rate.',
      ];
    }

    public function getKeyType()
    {
        return 'string';
    }
}
