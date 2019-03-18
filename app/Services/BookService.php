<?php

namespace App\Services;

use App\Contracts\Dao\BookDaoInterface;
use App\Contracts\Services\BookServiceInterface;
use App\Book;

class BookService implements BookServiceInterface
{
  private $bookDao;

  /**
   * Class Constructor
   * @param BookDaoInterface
   * @return
   */
  public function __construct(BookDaoInterface $bookDao)
  {
    $this->bookDao = $bookDao;
  }

  public function searchBookList(array $data)
  {
    return $this->bookDao->searchBookList($data);
  }

  public function bookList()
  {
    return $this->bookDao->bookList();
  }

  public function create($data)
  {
    $this->bookDao->create($data);
  }

  public function getGenre()
  {
    return $this->bookDao->getGenre();
  }

  public function getAuthor()
  {
    return $this->bookDao->getAuthor();
  }

  public function getBook()
  {
    return $this->bookDao->getBook();
  }

  public function updateBook($request,$book)
  {
    return $this->bookDao->updateBook($request,$book);
  }

  public function deleteBook($id)
  {
    return $this->bookDao->deleteBook($id);
  }

  public function getDownloadFile()
  {
    return $this->bookDao->getDownloadFile();
  }
}