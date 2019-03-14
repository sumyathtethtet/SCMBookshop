<?php

namespace App\Dao;

use App\Contracts\Dao\BookDaoInterface;
use App\Contracts\Services\BookServiceInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Book;
use App\Author;
use App\Genre;
use Config;
use Auth;
use Log;
use DB;

class BookDao implements BookDaoInterface
{
  public function searchBookList(array $data)
    {
      $name=$data[0];
      $author=$data[1];
      $genre=$data[2];
      Log::info($data[0]);
     
      return Book::whereNull('deleted_at')
                     ->where('name', 'LIKE', '%' . $name . '%')
                     ->where('author_id', 'LIKE', '%' . $author. '%')
                     ->where('genre_id','LIKE','%' . $genre. '%')
                     ->paginate(Config::get('constant.option_pagination'));

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
    $imageName=$data['name'].'.'.$file->getClientOriginalExtension();
    $fullImg='/books/'.$maxValue.'/'.$imageName;
    

    $filepdf = Input::file('sample_pdf');
    $pdf_name = $data['name'].'.'.$filepdf->getClientOriginalExtension();
    
    $user = Book::create([
      'name' => $data['name'],
      'price' => $data['price'],
      'author_id'=> $data['author'],
      'genre_id'=> $data['genre'],
      'image'=> $fullImg,
      'sample_pdf'=> $pdf_name,
      'published_date'=> $data['published_date'],
      'description'=> $data['description'],
      'create_user_id' => Auth::user()->id,
      'updated_user_id'=> Auth::user()->id,
    ]);

    $file->move(public_path('books/'.$maxValue),$imageName);
    $filepdf->move(public_path('books/'.$maxValue),$pdf_name);
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

  public function updateBook($request,$book)
  {
    $fullImg= request('oldImage');
    $name=request('name');

    $maxValue = Book::latest()->value('id');
    $maxValue++;

      if($request->file('image') !== null){
        $imageName = $name.'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('books/'.$maxValue),$imageName);
        $fullImg = '/books/'.$maxValue.'/'.$imageName;
      }
            
    $pdf_name=request('oldPDF');
          
      if($request->file('sample_pdf') !== null){
        $pdf_name = $name.'.'.request()->sample_pdf->getClientOriginalExtension();
        request()->sample_pdf->move(public_path('books/'.$maxValue),$pdf_name);
      }
      
      $book=Book::find($book);
      $book->name=request('name');
      $book->price=request('price');
      $book->author_id=request('author');
      $book->genre_id=request('genre');
      $book->image=$fullImg;
      $book->sample_pdf=$pdf_name;
      $book->published_date=request('published_date');
      $book->description=request('description');
      $book->create_user_id=Auth::user()->id;
      $book->updated_user_id=Auth::user()->id;
      $book->save();
  }

  public function deleteBook($id)
  {
    $data = Book::find($id);
    $data->deleted_user_id = auth()->id();
    $data->deleted_at = now();
    $data->save();
  }

}