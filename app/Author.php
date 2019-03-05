<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use Notifiable;

    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'name', 'history', 'description','create_user_id','updated_user_id','deleted_user_id'
    ];

    public function author() {
        return $this->belongsTo('App\User', 'create_user_id');
      }
    
    protected $hidden = [
         'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    
}
