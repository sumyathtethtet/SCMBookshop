<?php

namespace App\Dao;

use App\Contracts\Dao\BookDaoInterface;
use App\Contracts\Services\BookServiceInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use App\Book;
use App\Author;
use App\Genre;
use Config;
use Auth;
use Log;

class BookDao implements BookDaoInterface
{
  public function searchBookList($search)
    {
      $book = new Book;
      return $book->where('deleted_at', NULL)->where('name','LIKE','%'.$search.'%' )->paginate(Config::get('constant.option_pagination'))->appends(['search' => $search]);
    }

  public function bookList()
    {
      $book= new Book;
      return $book->where('deleted_at', NULL)->paginate(Config::get('constant.option_pagination'));
    }

  public function create($data)
  {
    $maxValue = Book::latest()->value('id');
    $maxValue++;
    
    $file = Input::file('image');
    $destinationPath = public_path(). '/books/'.$maxValue;
    $filename = $data['name'].'.jpg';
    $file->move($destinationPath, $filename);

    $file = Input::file('sample_pdf');
    $pdf_name = $data['name'].'_sample.pdf';
    $file->move($destinationPath, $pdf_name);

    $user = Book::create([
      'name' => $data['name'],
      'price' => $data['price'],
      'author_id'=> $data['author'],
      'genre_id'=> $data['genre'],
      'image'=> $filename,
      'sample_pdf'=> $pdf_name,
      'published_date'=> $data['published_date'],
      'description'=> $data['description'],
      'create_user_id' => Auth::user()->id,
      'updated_user_id'=> Auth::user()->id,
    ]); 
  }

  public function getBook()
  {
    return Book::get();
  }

  public function getAuthor()
  {
    return Author::get();
  }

  public function getGenre()
  {
    return Genre::get();
  }

}