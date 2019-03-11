<?php

namespace App\Contracts\Dao;

interface BookDaoInterface
{
  public function searchBookList($search);
  public function bookList();
  public function create($data);
  public function getGenre();
  public function getAuthor();
  public function getBook();
  
}