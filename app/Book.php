<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Author;
use App\Genre;
use DB;
use Log;

class Book extends Model
{
    //
    use Notifiable;
    
    use SoftDeletes;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'price', 'author_id','genre_id','image','sample_pdf','published_date','description','create_user_id','updated_user_id','deleted_user_id'
    ];
    

    public function author(){
    	return $this->belongsTo(Author::class);
    }

    public function genre(){
    	return $this->belongsTo(Genre::class);
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public static function insertData($data){
        if(!empty($data)) {
            
            DB::table('books')
                ->where('name', $data['name'])
                ->update($data);
            }
        else{
                DB::table('books')->insert($data);
            }
    }
}
