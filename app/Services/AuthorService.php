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
   * @param AuthorDaoInterface
   * @return
   */
  public function __construct(AuthorDaoInterface $authorDao)
  {
    $this->authorDao = $authorDao;
  }

  public function searchAuthorList($search)
  {
    return $this->authorDao->searchAuthorList($search);
  }

  public function authorList()
  {
    return $this->authorDao->authorList();
  }

  /**
  * Get User List
  * @param Object
  * @return $userList
  */
  public function create(array $data)
  {
    $this->authorDao->create($data);
  }

  public function getAuthor()
  {
    return $this->authorDao->getAuthor();
  } 
  
  public function updateAuthor($author)
  {
    return $this->authorDao->updateAuthor($author);
  }

  public function deleteauthor($id)
  {
    return $this->authorDao->deleteAuthor($id);
  }
}