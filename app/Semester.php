<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use Illuminate\Validation\Rule;

class Semester extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
    public function getKeyType()
    {
        return 'string';
    }
     public static function rules($id = '') 
    {
      return [
          'name' => [
            'required', 
            Rule::unique('semesters')->where(function ($query) {
                return $query->where('deleted', false);
            })->ignore($id)
          ],
      ];
    }

    public static function messages($id = '') 
    {
      return [
          'name.required' => 'You must enter semester name.',
          'name.unique' => 'The semester name is already exists.',
      ];
    }
}
