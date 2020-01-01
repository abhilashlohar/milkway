<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Webpatser\Uuid\Uuid;
use Illuminate\Validation\Rule;

class Marksheet extends Model
{
    protected $fillable = [
        'student_id','semester_id','year_id','marksheet_src','result'
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
      'student_id' => 'string',
      'semester_id' => 'string',
      'year_id' => 'string',

    ];

    public static function rules($id = '') 
    {
      return [
          'marksheet_file' => 'required|mimes:pdf|max:2048',
          'year_id' => 'required',
          'result' => 'required',
      ];
    }

    public static function messages($id = '') 
    {
      return [
          'year_id.required' => 'You must select year.',
          'marksheet_file.required' => 'You must select marksheet.',
          'result.required' => 'You must enter result like Pass or Fail etc.',
      ];
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function student(){
      return $this->belongsTo(Student::class);
    }

    public function year(){
      return $this->belongsTo(Year::class);
    }

    public function semester(){
      return $this->belongsTo(Semester::class);
    }
}
