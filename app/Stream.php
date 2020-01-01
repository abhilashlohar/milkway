<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use Illuminate\Validation\Rule;

class Stream extends Model
{
    protected $fillable = [
        'name','course_id'
    ];



    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = (string) Uuid::generate(4);
        });
    }

    protected $casts = [
      'id' => 'string',
      'course_id' => 'string'
    ];

    public static function rules($id = '') 
    {
      return [
          'name' => [
            'required', 
            Rule::unique('streams')->where(function ($query) {
                return $query->where('deleted', false);
            })->ignore($id)
          ],
          'course_id' => ['required'],
      ];
    }

    public static function messages($id = '') 
    {
      return [
          'name.required' => 'You must enter stream name.',
          'course_id.required' => 'You must select course name.',
          'name.unique' => 'The stream name is already exists.',
      ];
    }
    
    public function getKeyType()
    {
        return 'string';
    }

    public function course(){
      return $this->belongsTo(Course::class);
    }
}
