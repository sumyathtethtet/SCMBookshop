<?php

namespace App\Contracts\Services;

interface BookServiceInterface
{
  public function searchBookList($search);
  public function bookList();
  public function create($data);
  public function getGenre();
  public function getAuthor();
  public function getBook();
}