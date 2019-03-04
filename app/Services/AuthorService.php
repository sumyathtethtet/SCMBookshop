<?php

namespace App\Services;

use App\Contracts\Dao\AuthorDaoInterface;
use App\Contracts\Services\AuthorServiceInterface;
use App\Author;

class AuthorService implements AuthorServiceInterface
{
  private $authorDao;

  /**
   * Class Constructor
   * @param OperatorUserDaoInterface
   * @return
   */
  public function __construct(AuthorDaoInterface $authorDao)
  {
    $this->authorDao = $authorDao;
  }

  /**
   * Get User List
   * @param Object
   * @return $userList
   */
  public function deleteAuthor($request)
  {
    $this->authorDao->deleteAuthor($request);
  }
}