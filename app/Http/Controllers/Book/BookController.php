<?php

namespace App\Http\Controllers\Book;

use App\Book;
use App\Contracts\Services\BookServiceInterface;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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
        $search = Input::get('search');
        $genre = Input::get('genre');
        $author = Input::get('author');
        $data = array($search, $author, $genre);

        $genres = $this->bookInterface->getGenre();
        $authors = $this->bookInterface->getAuthor();

        if (count($data[0]) != null || count($data[1]) != null || count($data[2]) != null) {
            $results = $this->bookInterface->searchBookList($data);

            return view('list-book', compact('results', 'genres', 'authors'));
        } elseif ($data[0] == null || $data[1] == null || $data[2] == null) {
            $books = $this->bookInterface->bookList();
            return view('list-book', compact('books', 'genres', 'authors'));
        } else {
            return view('list-book', compact('genres', 'authors'))->withMessage('No Details found. Try to search again !');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadFile(Request $request)
    {

        $file = $request->file('file');

        // File Details
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();

        // Valid File Extensions
        $valid_extension = array("csv");

        // 2MB in Bytes
        $maxFileSize = 2097152;

        // Check file extension
        if (in_array(strtolower($extension), $valid_extension)) {

            // Check file size
            if ($fileSize <= $maxFileSize) {

                // File upload location
                $location = 'uploads';

                // Upload file
                $file->move($location, $filename);

                // Import CSV to Database
                $filepath = public_path($location . "/" . $filename);

                // Reading file
                $file = fopen($filepath, "r");

                $importData_arr = array();
                $i = 0;
                $u = 1;

                while (($filedata = fgetcsv($file, 1000, ",")) !== false) {
                    $num = count($filedata);

                    // Skip first row (Remove below comment if you want to skip the first row)
                    if ($i == 0) {
                        $i++;
                        continue;
                    }
                    for ($c = 0; $c < $num; $c++) {
                        $importData_arr[$i][] = $filedata[$c];
                    }
                    $i++;
                }

                fclose($file);

                $this->bookInterface->getUploadFile($importData_arr);
            }
        }
        return redirect('list-book');
    }

    /**
     * Export CSV file
     *
     */
    public function downloadFile()
    {
        $book = $this->bookInterface->getDownloadFile();
        $isFound = 0;

        if (count($book) > 0) {
            $isFound = 1;

            $CsvData = array('ID,Book Name,Author Name,Gener Name,Image,Sample PDF,Published Date,Description');
            foreach ($book as $value) {
                $CsvData[] = $value->id . ',' . $value->name . ',' . $value->author_id . ',' . $value->genre_id . ',' . $value->image . ',' . $value->sample_pdf . ',' . $value->published_date . ',' . $value->description;
            }

            $filename = "book.csv";
            $file_path = base_path() . '/' . $filename;
            $file = fopen($file_path, "w+");
            foreach ($CsvData as $exp_data) {
                fputcsv($file, explode(',', $exp_data));
            }
            fclose($file);

            $headers = ['Content-Type' => 'application/csv'];
            return response()->download($file_path, $filename, $headers);
        }
        return view('download', ['record_found' => $isFound]);
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
        $this->validate(request(), [
            'name' => 'required|max:255',
            'price' => 'required',
            'image' => 'required|image|mimes:jpg,png',
            'sample_pdf' => 'required|mimes:pdf,docx',
            'published_date' => 'required',
        ]);

        $this->bookInterface->create($request->all());
        return redirect('/list-book');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $genres = $this->bookInterface->getGenre();
        $authors = $this->bookInterface->getAuthor();
        return view('book.add-book', compact('authors', 'genres'));
    }

    /**
     * Display the specified resource.
     * @param $book_id
     * @return \Illuminate\Http\Response
     */
    public function showDetail(Book $book_id)
    {
        //
        return view('book.detail-book', compact('book_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $bookedit_id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $bookedit_id)
    {
        //
        $genres = $this->bookInterface->getGenre();
        $authors = $this->bookInterface->getAuthor();
        $books = $this->bookInterface->getBook();
        return view('book.edit-book', compact('books', 'bookedit_id', 'genres', 'authors'));
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
        $this->validate(request(), [
            'name' => 'required|max:255',
            'price' => 'required',
            'image' => 'image|mimes:jpg,png',
            'sample_pdf' => 'required|mimes:pdf,docx',
            'published_date' => 'required',
        ]);

        $book = request('postid');
        $author = $this->bookInterface->updateBook($request, $book);
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
