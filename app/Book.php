<?php

namespace App;

use App\Author;
use App\Genre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

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
        'name', 'price', 'author_id', 'genre_id', 'image', 'sample_pdf', 'published_date', 'description', 'create_user_id', 'updated_user_id', 'deleted_user_id',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public static function insertData($data)
    {

        $value = Book::where('name', $data['name'])->get();

        if ($value->count() == 0) {
            Book::insert($data);
        } else if (!empty($data)) {
            Book::where('name', $data['name'])->update($data);
        }
    }
}
