<?php

namespace App\Services;

use App\Contracts\Dao\GenreDaoInterface;
use App\Contracts\Services\GenreServiceInterface;
use App\Genre;

class GenreService implements GenreServiceInterface
{
  private $genreDao;

  /**
   * Class Constructor
   * @param GenreDaoInterface
   * @return
   */
  public function __construct(GenreDaoInterface $genreDao)
  {
    $this->genreDao = $genreDao;
  }

  public function searchGenreList($search)
  {
    return $this->genreDao->searchGenreList($search);
  }

  public function genreList()
  {
    return $this->genreDao->genreList();
  }

  /**
  * Get User List
  * @param Object
  * @return $userList
  */
  public function create(array $data)
  {
    $this->genreDao->create($data);
  }

  public function getGenre()
  {
    return $this->genreDao->getGenre();
  }
  
  public function updateGenre($author)
  {
    return $this->genreDao->updateGenre($author);
  }

  public function deleteGenre($id)
  {
    return $this->genreDao->deleteGenre($id);
  }
}