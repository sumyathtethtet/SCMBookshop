<?php

namespace App\Contracts\Dao;

interface GenreDaoInterface
{
  //get user list

  public function searchGenreList($search);
  public function genreList();
  public function create(array $data);
  public function getGenre();
  public function updateGenre($author);
  public function deleteGenre($id); 
  
  
}