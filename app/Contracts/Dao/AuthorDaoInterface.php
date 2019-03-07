<?php

namespace App\Contracts\Dao;

interface AuthorDaoInterface
{
  public function searchAuthorList($search);
  public function authorList();
  public function create(array $data);
  public function getAuthor(); 
  public function updateAuthor($author);
  public function deleteAuthor($id);
  
}