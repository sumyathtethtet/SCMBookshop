<?php

namespace App\Contracts\Dao;

interface BookDaoInterface
{
    public function searchBookList(array $data);
    public function bookList();
    public function create($data);
    public function getGenre();
    public function getAuthor();
    public function getBook();
    public function updateBook($request, $author);
    public function deleteBook($id);
    public function getUploadFile($importData_arr);
    public function getDownloadFile();

}
