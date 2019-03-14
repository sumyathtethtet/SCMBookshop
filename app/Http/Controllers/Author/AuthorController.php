<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Contracts\Services\AuthorServiceInterface;
use App\Author;

class AuthorController extends Controller
{
    private $authorInterface;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthorServiceInterface $authorInterface)
    {
        $this->middleware('admin');
        $this->authorInterface = $authorInterface;
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
            $results=$this->authorInterface->searchAuthorList($search);
            return view('list-author')->with('results', $results);
        }

        elseif(count($search)==null){
            $authors=$this->authorInterface->authorList();
            return view('list-author')->with('authors', $authors);
        }

        else
            return view('list-author')->withMessage('No Details found. Try to search again !');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data,[
            'name' => ['required', 'string', 'max:255'],
            'history' => ['required'],
        ]);
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
        $this->validator($request->all())->validate();
        $this->authorInterface->create($request->all());
        return redirect('list-author');
    }

    /**
    * Show the form for editing the specified resource.
     *
     * @param  int  $authoredit_id
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $authoredit_id)
    {
        //
        $authors = $this->authorInterface->getAuthor();
        return view('author.edit-author',compact('authors','authoredit_id'));
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
            'name'=>'required',
            'history'=>'required',
        ]);

        $author=request('postid');
        $author=$this->authorInterface->updateAuthor($author);
        return redirect('list-author');
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
        $this->authorInterface->deleteAuthor($id);
        return redirect('list-author');
    }
}
