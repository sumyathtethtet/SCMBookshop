<?php

namespace App\Http\Controllers\Book;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\Services\BookServiceInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use Illuminate\Auth\Events\Registered;
use App\Book;
use Log;
use Config;


class BookController extends Controller
{
    private $bookInterface;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BookServiceInterface $bookInterface)
    {
        $this->bookInterface = $bookInterface;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $search = Input::get ( 'search' );
        $genre = Input::get ('genre'); 
        $author = Input::get ('author');
        $data = array($search, $author, $genre);
        $genres=$this->bookInterface->getGenre();
        $authors=$this->bookInterface->getAuthor();

        if(count($data[0]) !=null || count($data[1]) !=null || count($data[2]) !=null){
            $results=$this->bookInterface->searchBookList($data);
            
            return view('list-book',compact('results','genres','authors'));
        }

        elseif($data[0] ==null || $data[1] ==null || $data[2] ==null){
            $books=$this->bookInterface->bookList();
            return view('list-book',compact('books','genres','authors'));
        }

        else
        return view('list-book',compact('genres','authors'))->withMessage('No Details found. Try to search again !');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate(request(),[
            'name' => 'required|max:255',
            'price' => 'required',
            'image'=>'image|mimes:jpg,png',
            'sample_pdf' => 'required|mimes:pdf,docx',
            'published_date' => 'required',
        ]);
        
        $this->bookInterface->create($request->all());
        return redirect('list-book');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $genres=$this->bookInterface->getGenre();
        $authors=$this->bookInterface->getAuthor();
        return view('book.add-book',compact('authors','genres'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $bookedit_id)
    {
        //
        $genres=$this->bookInterface->getGenre();
        $authors=$this->bookInterface->getAuthor();
        $books = $this->bookInterface->getBook();
        return view('book.edit-book',compact('books','bookedit_id','genres','authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $this->validate(request(),[
            'name' => 'required|max:255',
            'price' => 'required',
            'image'=>'image|mimes:jpg,png',
            
            'published_date' => 'required',
        ]);

        $book=request('postid');
        $author=$this->bookInterface->updateBook($request,$book);
        return redirect('list-book');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->bookInterface->deleteBook($id);
        return redirect('list-book');
    }
}
