<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Webpatser\Uuid\Uuid;
use Illuminate\Validation\Rule;

class Course extends Model
{
    use Notifiable;

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

     public static function rules($id = '') 
    {
      return [
          'name' => [
            'required', 
            Rule::unique('courses')->where(function ($query) {
                return $query->where('deleted', false);
            })->ignore($id)
          ],
      ];
    }

    public static function messages($id = '') 
    {
      return [
          'name.required' => 'You must enter course name.',
          'name.unique' => 'The course name is already exists.',
      ];
    }

    public function getKeyType()
    {
        return 'string';
    }
    
    public function streams(){
        $this->hasMany(Stream::class);
    }
}
