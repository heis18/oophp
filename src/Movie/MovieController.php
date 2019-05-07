<?php

namespace Heis\Movie;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class MovieController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    // private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
//     public function initialize() : void
//     {
//         // Use to initialise member variables.
//         $this->db = "active";
//         $app->db->connect();
//
//         // Use $this->app to access the framework services.
//     }
//
// $data["resultset"] = $res;
//
// $app->view->add("movie/index", $data);
// $app->page->render($data);


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function indexAction() : object
    {
        $title = "Movie database | oophp";

        $this->app->db->connect();

        $sql = "SELECT * FROM movie;";
        $res = $this->app->db->executeFetchAll($sql);

        $this->app->view->add("movie/header");
        $this->app->view->add("movie/index", [
            "resultset" => $res,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    /**
    * @return object
    */
   public function searchTitleAction() : object
    {
        $title = "Search Movie Title | oophp";

        $request = $this->app->request;
        $this->app->db->connect();
        $resultset = null;

        $searchTitle = $request->getGet("searchTitle");

        if ($searchTitle) {
           $sql = "SELECT * FROM movie WHERE title LIKE ?;";
           $resultset = $this->app->db->executeFetchAll($sql, [$searchTitle]);
        }

        $this->app->view->add("movie/header");
        $this->app->view->add("movie/search-title", [
            "searchTitle" => $searchTitle,
        ]);
        $this->app->view->add("movie/index", [
           "resultset" => $resultset,
        ]);

        return $this->app->page->render([
           "title" => $title,
        ]);
    }


       /**
       * @return object
       */
    public function searchYearAction() : object
    {
        $title = "Search Movie Year | oophp";

        $request = $this->app->request;
        $this->app->db->connect();
        $resultset = null;

        $year1 = $request->getGet("year1");
        $year2 = $request->getGet("year2");
        if ($year1 && $year2) {
           $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
           $resultset = $this->app->db->executeFetchAll($sql, [$year1, $year2]);
        } elseif ($year1) {
           $sql = "SELECT * FROM movie WHERE year >= ?;";
           $resultset = $this->app->db->executeFetchAll($sql, [$year1]);
        } elseif ($year2) {
           $sql = "SELECT * FROM movie WHERE year <= ?;";
           $resultset = $this->app->db->executeFetchAll($sql, [$year2]);
        }

        $this->app->view->add("movie/header");
        $this->app->view->add("movie/search-year", [
            "year1" => $year1,
            "year2" => $year2,
        ]);
        $this->app->view->add("movie/index", [
           "resultset" => $resultset,
        ]);

        return $this->app->page->render([
           "title" => $title,
        ]);
    }


    /**
    * @return object
    */
    public function movieSelectAction() : object
    {
        $title = "Select a movie | oophp";

        $request = $this->app->request;
        $this->app->db->connect();

        $movieId = $request->getPost("movieId");
        if ($request->getPost("doDelete")) {
            $sql = "DELETE FROM movie WHERE id = ?;";
            $this->app->db->execute($sql, [$movieId]);
            header("Location: index");
            exit;
        } elseif ($request->getPost("doAdd")) {
            $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
            $this->app->db->execute($sql, ["A title", 2017, "img/noimage.png"]);
            $movieId = $this->app->db->lastInsertId();
            header("Location: movie-edit?movieId=$movieId");
            exit;

        } elseif ($request->getPost("doEdit") && is_numeric($movieId)) {
            header("Location: movie-edit?movieId=$movieId");
            exit;
        }

        $sql = "SELECT id, title FROM movie;";
        $movies = $this->app->db->executeFetchAll($sql);

        $this->app->view->add("movie/header");
        $this->app->view->add("movie/movie-select", [
           "movieId" => $movieId,
           "movies" => $movies,
        ]);

        return $this->app->page->render([
           "title" => $title,
        ]);
    }








    public function movieEditAction() : object
    {
      $title = "Add or edit a movie | oophp";
      $request = $this->app->request;
      $this->app->db->connect();



      $movieId    = $request->getPost("movieId") ?: $request->getGet("movieId");
      $movieTitle = $request->getPost("movieTitle");
      $movieYear  = $request->getPost("movieYear");
      $movieImage = $request->getPost("movieImage");

      if ($request->getPost("doSave")) {
          $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
          $this->app->db->execute($sql, [$movieTitle, $movieYear, $movieImage, $movieId]);
          header("Location: movie-select");
          exit;
      }



      $sql = "SELECT * FROM movie WHERE id = ?;";
      $movie = $this->app->db->executeFetchAll($sql, [$movieId]);
      $movie = $movie[0];


      $this->app->view->add("movie/header");
      $this->app->view->add("movie/movie-edit", [
         "movieId" => $movieId,
         "movieTitle" => $movieTitle,
         "movieYear" => $movieYear,
         "movieImage" => $movieImage,
         "movie" => $movie,
      ]);


      return $this->app->page->render([
         "title" => $title,
      ]);
    }
}
