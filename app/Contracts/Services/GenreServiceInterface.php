<?php

namespace App\Contracts\Services;

interface GenreServiceInterface
{
  //get user list
  
  public function searchGenreList($search);
  public function genreList();
  public function create(array $data);
  public function getGenre();
  public function updateGenre($author);
  public function deleteGenre($id);
}