<?php

namespace App\Http\Controllers\Book;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\Services\BookServiceInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Auth\Events\Registered;
use App\Book;
use Log;

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
        if(count($search) > 0){
            $results=$this->bookInterface->searchBookList($search);
            return view('list-book')->with('results', $results);
        }

        elseif(count($search)==null){
            $books=$this->bookInterface->bookList();
            return view('list-book')->with('books', $books);
        }

        else
            return view('list-book')->withMessage('No Details found. Try to search again !');
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:books',
            'price' => 'required',
            'author_id' => 'required',
            'genre_id' => 'required',
            'image' => 'required|mimes:jpg,png',
            'sample_pdf' => 'required|mines:pdf,docx',
            'published_date' => 'required',
            'description' => 'required',
        ]);
        
        $this->bookInterface->create($request->all());
        return view('list-book');
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
    public function update(Request $request, $id)
    {
        //
        $this->validate(request(),[
            'name' => 'required|unique:books',
            'price' => 'required',
            'author_id' => 'required',
            'genre_id' => 'required',
            'image' => 'required|mimes:jpg,png',
            'sample_pdf' => 'required|mines:pdf,docx',
            'published_date' => 'required',
            'description' => 'required',
        ]);

        $author=request('postid');
        $author=$this->genreInterface->updateGenre($author);
        return redirect('list-genre');
    }

    // $this->validate(request(),[
    //     'title'=>'required|min:5',

    //     //'photo'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     'intro'=>'required|min:5',
    //     'price'=>'required',
    //     'description'=>'required|min:10'
    // ]);
    
    // $fullImg= request('oldphoto');

    // if($request->file('newphoto') !== null){
    //     $imageName=time().'.'.request()->newphoto->getClientOriginalExtension();
    // request()->newphoto->move(public_path('images'),$imageName);
    // $fullImg='/images/'.$imageName;

    // }


    
    // $cour=request('postid');
     
    
    //     $courpost=CoursePost::find($cour);
    //     $courpost->title=request('title');
    //     $courpost->intro=request('intro');
    //     $courpost->course_id=request('course');
    //     $courpost->photo=$fullImg;
    //     $courpost->price=request('price');
    //     $courpost->description=request('description');
    //     $courpost->specs=request('specs');
    //     $courpost->lessons=request('lessons');
    //     $courpost->instructor=request('instructor');
    //     $courpost->duration=request('duration');
    //     $courpost->user_id=auth()->id();
    //     $courpost->save();

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
