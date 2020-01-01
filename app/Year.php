<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use Illuminate\Validation\Rule;

class Year extends Model
{
    protected $fillable = [
        'name'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = (string) Uuid::generate(4);
        });
    }

    protected $casts = [
      'id' => 'string'
    ];


    public static function rules($id = '') 
    {
      return [
          'name' => [
            'required', 
            Rule::unique('years')->where(function ($query) {
                return $query->where('deleted', false);
            })->ignore($id)
          ],
      ];
    }

    public static function messages($id = '') 
    {
      return [
          'name.required' => 'You must enter year name.',
          'name.unique' => 'The year name is already exists.',
      ];
    }
    public function getKeyType()
    {
        return 'string';
    }

}
