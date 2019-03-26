<?php

namespace App\Contracts\Services;

interface BookServiceInterface
{
    public function searchBookList(array $data);
    public function bookList();
    public function create($data);
    public function getGenre();
    public function getAuthor();
    public function getBook();
    public function updateBook($request, $book);
    public function deleteBook($id);
    public function getUploadFile($importData_arr);
    public function getDownloadFile();
}
