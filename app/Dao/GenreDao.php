<?php

namespace App\Dao;

use App\Contracts\Dao\GenreDaoInterface;
use App\Genre;
use Auth;
use Config;

class GenreDao implements GenreDaoInterface
{
    public function searchGenreList($search)
    {

        $genre = new Genre;
        return $genre->where('deleted_at', null)->where('name', 'LIKE', '%' . $search . '%')->paginate(Config::get('constant.option_pagination'))->appends(['search' => $search]);
    }

    public function genreList()
    {
        $genre = new Genre;
        return $genre->where('deleted_at', null)->paginate(Config::get('constant.option_pagination'));
    }

    /**
     * Get Operator List
     * @param Object
     * @return $operatorList
     */
    public function create(array $data)
    {
        $user = Genre::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'create_user_id' => Auth::user()->id,
            'updated_user_id' => Auth::user()->id,

        ]);
    }

    public function getGenre()
    {
        return Genre::get();
    }

    public function updateGenre($author)
    {
        $author = Genre::find($author);
        $author->name = request('name');
        $author->description = request('description');
        $author->create_user_id = Auth::user()->id;
        $author->updated_user_id = auth()->id();
        $author->save();
    }

    public function deleteGenre($id)
    {
        $data = Genre::find($id);
        $data->deleted_user_id = auth()->id();
        $data->deleted_at = now();
        $data->save();
    }

}
