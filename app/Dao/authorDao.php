<?php

namespace App\Dao;

use App\Contracts\Dao\AuthorDaoInterface;
use App\Contracts\Services\AuthorServiceInterface;
use Illuminate\Pagination\Paginator;
use App\Author;
use Config;
use Auth;

class AuthorDao implements AuthorDaoInterface
{
  
  public function searchAuthorList($search)
  {
    $author = new Author;
    
    return $author->whereNull('deleted_at')
    ->where('name','LIKE','%'.$search.'%' )
    ->paginate(Config::get('constant.option_pagination'))
    ->appends(['search' => $search]);
  }

  public function authorList()
  {
    $author= new Author;
    return $author->where('deleted_at', NULL)->paginate(Config::get('constant.option_pagination'));
    
  }

  public function create(array $data)
  {
      $user = Author::create([
      'name' => $data['name'],
      'history' => $data['history'],
      'description'=> $data['description'],
      'create_user_id' => Auth::user()->id,
      'updated_user_id'=> Auth::user()->id,
    ]);
  }

  public function getAuthor()
  {
    return Author::get();
  }
  
  public function updateAuthor($author)
  {
    $author=Author::find($author);
    $author->name=request('name');
    $author->history=request('history');
    $author->description=request('description');
    $author->create_user_id=Auth::user()->id;
    $author->updated_user_id=auth()->id();
    $author->save();
  }

  public function deleteAuthor($id)
  {
    $data = Author::find($id);
    $data->deleted_user_id = auth()->id();
    $data->deleted_at = now();
    $data->save();
  }
}