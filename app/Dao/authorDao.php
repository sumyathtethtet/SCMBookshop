<?php

namespace App\Dao;

use App\Contracts\Dao\AuthorDaoInterface;
use App\Contracts\Services\AuthorServiceInterface;
use App\Author;

class AuthorDao implements AuthorDaoInterface
{
private $authorService;
  
    /**
     * Class Constructor
     * @param OperatorUserDaoInterface
     * @return
     */
    public function __construct(AuthorServiceInterface $authorService)
    {
      $this->authorService = $authorService;
    }
  /**
   * Get Operator List
   * @param Object
   * @return $operatorList
   */
  public function deleteAuthor($request)
  {
    
    $author = Author::find($request);
    $author->delete();
  }
}