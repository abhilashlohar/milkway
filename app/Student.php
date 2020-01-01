<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use Illuminate\Validation\Rule;

class Student extends Model
{
     protected $fillable = [
      'enrollment', 'name', 'father_name', 'mother_name', 'dob', 'course_id', 'stream_id'
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
      'course_id' => 'string',
      'stream_id' => 'string',
      'dob' => 'date:d-m-y'
    ];

    public static function rules($id = '') 
    {
      return [
          'enrollment' => [
            'required', 
            Rule::unique('students')->ignore($id)
          ],
          'name' => 'required',
          'course_id' => 'required',
      ];
    }

    public static function messages($id = '') 
    {
      return [
          'enrollment.required' => 'You must enter enrollment number.',
      ];
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function course(){
      return $this->belongsTo(Course::class);
    }

    public function stream(){
      return $this->belongsTo(Stream::class);
    }
    public function marksheets(){
      return $this->hasMany(Marksheet::class);
    }
}
