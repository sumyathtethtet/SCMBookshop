<?php

namespace App\Http\Controllers\Genre;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Contracts\Services\GenreServiceInterface;
use App\Genre;

class GenreController extends Controller
{
    private $genreInterface;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(GenreServiceInterface $genreInterface)
    {
        $this->genreInterface = $genreInterface;
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
            $results=$this->genreInterface->searchGenreList($search);
            return view('list-genre')->with('results', $results);
        }

        elseif(count($search)==null){
            $genres=$this->genreInterface->genreList();
            return view('list-genre')->with('genres', $genres);
        }

        else
            return view('list-genre')->withMessage('No Details found. Try to search again !');
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
        $this->genreInterface->create($request->all());
        return redirect('list-genre');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $generedit_id
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genreedit_id)
    {
        $genres = $this->genreInterface->getGenre();
        return view('genre.edit-genre',compact('genres','genreedit_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $this->validate(request(),[
            'name'=>'required',
        ]);

        $author=request('postid');
        $author=$this->genreInterface->updateGenre($author);
        return redirect('list-genre');
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
        $this->genreInterface->deleteGenre($id);
        return redirect('list-genre');
    }
}
