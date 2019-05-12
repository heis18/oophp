<?php

namespace Heis\Blog;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

use function Anax\View\url;

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
class BlogController implements AppInjectableInterface
{
    use AppInjectableTrait;

    public function testAction(){
      return $this->app->view->render();
    }

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
	    $this->app->session->set("flashmessage","pelle");
        $title = "Blog database | oophp";

        $this->app->db->connect();

        $res = [];
        $sql = "SELECT * FROM content;";
        $res = $this->app->db->executeFetchAll($sql);

        $this->app->view->add("blog/header");
        $this->app->view->add("blog/index", [
            "resultset" => $res,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
    * @return object
    */
    public function adminAction() : object
    {
        $title = "Blog admin | oophp";

        $this->app->db->connect();

        $res = [];
        $sql = "SELECT * FROM content;";
        $res = $this->app->db->executeFetchAll($sql);

        $this->app->view->add("blog/header");
        $this->app->view->add("blog/admin", [
            "resultset" => $res,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }





    public function editAction() : object
    {

        $title = "Edit blogcontent | oophp";


        $request = $this->app->request;
        $this->app->db->connect();


        $id = $request->getGet("id");
        $editBlog = $this->getBlog($id);

        $this->app->view->add("blog/header");

        $this->app->view->add("blog/blog-edit",[
          "blog" => $editBlog,
        ]);

        return $this->app->page->render([
           "title" => $title,
        ]);
    }




    public function getBlog($id){
        $blog = null;

        if($id == -1){
          return createDummy();
        }
        else
        {
            $sql = "SELECT * FROM content WHERE id = ?;";
            $data = $this->app->db->executeFetchAll($sql, [$id]);
            return new Blog($data[0]);
        }

        return $blog;
      }


      public function slugExists($slug,$id){
          if(null == $slug){
            return false;
          }

          $sql = "SELECT id FROM content WHERE slug = ? and id <> ?;";
          $data = $this->app->db->executeFetchAll($sql, [$slug, $id]);
          if(count($data) > 0){
            return true;
          }

          return false;
      }


      public function addBlog($blog){
          die("INTE FÄRDIG addBlog");
        //     $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
        //     $this->app->db->execute($sql, ["A title", 2017, "img/noimage.png"]);
        return $this->app->db->lastInsertId();
      }

    public function updateBlog($blog)
    {
            $sql = "UPDATE content SET title = ?, path = ?, slug = ?, data = ?, type = ?, filter = ?, published = ? WHERE id = ?;";

            $this->app->db->execute($sql, [$blog->getContentTitle(),
              $blog->getContentPath(),
              $blog->getContentSlug(),
              $blog->getContentData(),
              $blog->getContentType(),
              $blog->getContentFilter(),
              $blog->getContentPublish(),
              $blog->getId()]);
    }

    public function deleteBlog($id){
          $sql = "update content set deleted = now() WHERE id = ?;";
          $this->app->db->execute($sql, [$id]);
    }

    public function addAction() : int
    {

    }

    /*
    * @return object
    */
    public function updateAction() : object
    {
        $title = "Edit";
        $request = $this->app->request;
        $this->app->db->connect();

        $contentId    = $request->getPost("contentId") ?: $request->getGet("id");
        $contentTitle = $request->getPost("contentTitle");
        $contentPath  = $request->getPost("contentPath");
        $contentSlug = $request->getPost("contentSlug");
        $contentData = $request->getPost("contentData");
        $contentType = $request->getPost("contentType");
        $contentFilter = $request->getPost("contentFilter");
        $contentPublish = $request->getPost("contentPublish");

        if($contentSlug == ""){
          $contentSlug = null;
        }

        if($contentTitle == ""){
          $contentTitle = null;
        }


        if ($request->getPost("doDelete")) {
          $this->deleteBlog($contentId);
        // } else if($request->getPost("doAdd")) {
        //   $editBlog = new Blog();
        //
        //   $editBlog->setContentPath($contentPath);
        //   $editBlog->setContentSlug($contentSlug);
        //   $editBlog->setContentData($contentData);
        //   $editBlog->setContentType($contentType);
        //   $editBlog->setContentFilter($contentFilter);
        //   $editBlog->setContentPublish($contentPublish);
//        $editBlog->setContentTitle($contentTitle);

        //
        //   $this->addBlog($editBlog);

        } elseif ($request->getPost("doSave") && is_numeric($contentId)) {

          $editBlog = $this->getBlog($contentId);
          if($contentSlug ==  null && $contentTitle != null){
              $contentSlug = slugify($contentTitle);
          }

          // First check to see if there is a duplicate slug.
          // That is a no no.
          $oldSlug = $editBlog->getContentSlug();

          $editBlog->setContentTitle($contentTitle);
          $editBlog->setContentPath($contentPath);
          $editBlog->setContentSlug($contentSlug);
          $editBlog->setContentData($contentData);
          $editBlog->setContentType($contentType);
          $editBlog->setContentFilter($contentFilter);
          $editBlog->setContentPublish($contentPublish);

          // Validate rules
          if($this->slugExists($contentSlug,$contentId)){
            $title = "Blog error";
            $this->app->view->add("blog/header");
            $this->app->view->add("blog/blog-edit",[
              "blog" => $editBlog,
              "message" => "Slug already exists pick a new unique value."
            ]);

            return $this->app->page->render([
               "title" => $title,
            ]);
          }

          $this->updateBlog($editBlog);
        } else {
          die("Ogitligt alternativ ");
        }

        return $this->app->response->redirect(url("blog/admin"));
        ///return $this->app->response->redirect(url("blog/admin"));
    }

    public function errorAction(){
      $title = "Blog error";
      $this->app->view->add("blog/header");
      $this->app->view->add("blog/error",[
        "message" => $this->app->request->getGet('message'),
      ]);

      return $this->app->page->render([
         "title" => $title,
      ]);
    }
}
