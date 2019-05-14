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

    public function test3Action()
    {
        //$route = $this->app->page->view->add();
        //$this->app->view->add("blog/header");
        //$this->app->page->add("blog/test",["data" => "nisse"]);
        return '<b>nisse</b>';
    }

    public function testAction()
    {
        $route = "block/footer";

        $content = $this->app->content->contentForInternalRoute($route);
        var_dump($content->views["main"]["data"]);
//      $this->app->view->add("blog/test");

      //return $this->app->page->render();
      //var_dump($this->app->view->get("blog/header"));
      //return $this->app->view->render("blog/header");
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
        //$this->app->session->set("flashmessage","");
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



    public function createAction(): object
    {
        $title = "Add blogcontent | oophp";
        $this->app->view->add("blog/header");
        $this->app->view->add("blog/blog-create", [
          "blog" => new Blog(),
        ]);

        return $this->app->page->render([
           "title" => $title,
        ]);
    }

    public function doCreateAction() : object
    {
        $this->app->db->connect();
        $contentTitle = $this->app->request->getPost("contentTitle");
        $editBlog = new Blog();
        $editBlog->setContentTitle($contentTitle);

        $id = $this->createBlog($editBlog);

        $url = url("blog/edit")."?id=$id";
        return $this->app->response->redirect($url);
    }


    public function editAction() : object
    {
        $title = "Edit blogcontent | oophp";

        $request = $this->app->request;
        $this->app->db->connect();

        $id = $request->getGet("id");
        $editBlog = $this->getBlog($id);

        $this->app->view->add("blog/header");
        $this->app->view->add("blog/blog-edit", [
          "blog" => $editBlog,
        ]);

        return $this->app->page->render([
           "title" => $title,
        ]);
    }




    public function deleteAction()
    {
        $title = "Edit";
        $request = $this->app->request;
        $contentId = $request->getPost("contentId") ?: $request->getGet("id");
        if (is_numeric($contentId)) {
            $this->app->db->connect();
            $this->deleteBlog($contentId);
        }
        return $this->app->response->redirect(url("blog/admin"));
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

        if ($contentSlug == "") {
            $contentSlug = null;
        }

        if ($contentTitle == "") {
            $contentTitle = null;
        }

        $delete = $request->getPost("doDelete") ?: $request->getGet("doDelete");
        if ($delete && is_numeric($contentId)) {
            $this->deleteBlog($contentId);
        } elseif ($request->getPost("doSave") && is_numeric($contentId)) {
            $editBlog = $this->getBlog($contentId);
            if ($contentSlug ==  null && $contentTitle != null) {
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
            if ($this->slugExists($contentSlug, $contentId)) {
                $title = "Blog error";
                $this->app->view->add("blog/header");
                $this->app->view->add("blog/blog-edit", [
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

    public function pagesAction() : object
    {
        $title = "Pages | oophp";

        $this->app->db->connect();

        $pages = null;
        $res = [];
        $sql = "SELECT * FROM content where type='page' ;";
        $resultSet = $this->app->db->executeFetchAll($sql, []);

        $res[] = $this->getBlog(-1);
        foreach ($resultSet as $item) {
            $res[] = new Blog($item);
        }

        $this->app->view->add("blog/header");
        $this->app->view->add("blog/pages", [
          "resultset" => $res,
          ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    public function pageAction() : object
    {
        $title = "Pages | oophp";

        $this->app->db->connect();

        $sql = "SELECT * FROM content;";
        $res = $this->app->db->executeFetchAll($sql);

        if (count($res) == 0) {
            $page = $this->getBlog(-1);
        } else {
            $page = new Blog($res[0]);
        }

        $page = $this->getBlog(1);
        $this->app->view->add("blog/header");
        $this->app->view->add("blog/page", [
          "content" => $page,
          ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    public function blogAction() : object
    {
        $title = "Blog | oophp";

        $this->app->db->connect();

        $pages = null;
        $res = [];
        $sql = "SELECT * FROM content where type='post' ;";
        $resultSet = $this->app->db->executeFetchAll($sql, []);

        $res[] = $this->getBlog(-1);
        foreach ($resultSet as $item) {
            $res[] = new Blog($item);
        }

        $this->app->view->add("blog/header");
        $this->app->view->add("blog/blog", [
          "resultset" => $res,
          ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    public function blogpostAction() : object
    {
        $title = "Blogpost | oophp";

        $this->app->db->connect();

        $sql = "SELECT * FROM content;";
        $res = $this->app->db->executeFetchAll($sql);


        if (count($res) == 0) {
            $page = $this->getBlog(-1);
        } else {
            $page = new Blog($res[0]);
        }

        $page = $this->getBlog(1);
        $this->app->view->add("blog/header");
        $this->app->view->add("blog/blogpost", [
          "content" => $page,
          ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    private function getBlog($id)
    {
        $blog = null;

        if ($id == -1) {
            return (new Blog())->createDummy();
        } else {
            $sql = "SELECT * FROM content WHERE id = ?;";
            $data = $this->app->db->executeFetchAll($sql, [$id]);
            return new Blog($data[0]);
        }
        return $blog;
    }



    private function createBlog($blog) : int
    {
        $sql = "INSERT INTO content (title) VALUES (?);";
        $this->app->db->execute($sql, [$blog->getContentTitle()]);
        return $this->app->db->lastInsertId();
    }



    private function updateBlog($blog)
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

    private function deleteBlog($id)
    {
        $sql = "update content set deleted = now() WHERE id = ?;";
        $this->app->db->execute($sql, [$id]);
    }


    private function slugExists($slug, $id)
    {
        if (null == $slug) {
            return false;
        }

        $sql = "SELECT id FROM content WHERE slug = ? and id <> ?;";
        $data = $this->app->db->executeFetchAll($sql, [$slug, $id]);
        if (count($data) > 0) {
            return true;
        }
        return false;
    }
}
