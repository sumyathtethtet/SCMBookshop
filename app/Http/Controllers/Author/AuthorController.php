<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use App\Author;
use App\User;
use Auth;
use DB;
use Log;

class AuthorController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $search = Input::get ( 'search' );
        Log:info($search);
        if(count($search) > 0){
            $results= DB::table('authors')->where('deleted_at', NULL)->where('name','LIKE','%'.$search.'%' )->paginate(2);
            
            
            return view('list-author')->with('results', $results);
        }
        elseif(count($search)==null){
            $authors=DB::table('authors')->where('deleted_at',NULL)->paginate(2);
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
            'description' => ['required']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Author
     */
    public function create(array $data)
    {
        //
        $user = Author::create([
            'name' => $data['name'],
            'history' => $data['history'],
            'description'=> $data['description'],
            'create_user_id' => Auth::user()->id,
            'updated_user_id'=> Auth::user()->id,
           
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
        $this->create($request->all());
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
            $authors=Author::all();
            
            return view('author.edit-author',compact('authors','authoredit_id'));
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
            'name'=>'required|unique:form_types,name,'.$id.',id,deleted_at,NULL',
            'history'=>'required',
            
        ]);
        $author=request('postid');
        
       
           $author=Author::find($author);
           $author->name=request('name');
           $author->history=request('history');
           $author->description=request('description');
           $author->create_user_id=Auth::user()->id;
           $author->updated_user_id=auth()->id();
           
           
           $author->save();
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
        $data = Author::find($id);
        $data->deleted_user_id = auth()->id();
        $data->deleted_at = now();
        $data->save();
        return redirect('list-author');
    }

    
    
}
