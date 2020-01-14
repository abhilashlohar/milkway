<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
      'enrollment', 'name', 'mobile', 'deleted'
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
          'mobile' => 'required',
      ];
    }

    public static function messages($id = '') 
    {
      return [
          'name.required' => 'You must enter name.',
      ];
    }

    public function getKeyType()
    {
        return 'string';
    }
}
