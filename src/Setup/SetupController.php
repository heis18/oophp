<?php

namespace Heis\Setup;

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
class SetupController implements AppInjectableInterface
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
        $this->app->view->add("setup/setup");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    public function resetSuccessAction(): object
    {
        $title = "Reset database success | oophp";

        $this->app->view->add("setup/reset-db-success");

        return $this->app->page->render([
          "title" => $title,
        ]);
    }



    /**
    * @return object
    */
    public function resetAction() : object
    {
        $title = "Reset database | oophp";
        $sqlCommands = [];

        $sqlText = file_get_contents("../sql/movie/setup.sql");

        $sqlCommands = explode(";", $sqlText);

        for ($i = 0; $i < count($sqlCommands); $i++) {
            $sqlCommands[$i] = trim($sqlCommands[$i]);
        }

        $this->app->db->connect();
        foreach ($sqlCommands as $sql) {
            // if row starts with -- or " --" then skip it.
            $hasComment = strpos(trim($sql), "--");
            if ($hasComment > 0 && $hasComment < 5) {
                continue;
            }

            if (trim($sql) != "") {
                  $sql = $sql . ";\n";
                  //echo "$sql\n<br/>";
              //    $res = $this->app->db->execute($sql);
            }
        }
        return $this->app->response->redirect(url("setup/resetsuccess"));

        return $this->app->page->render([
          "title" => $title,
        ]);
    }
}
