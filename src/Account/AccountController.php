<?php

namespace Heis\Account;

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
class AccountController implements AppInjectableInterface
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
        $title = "Login | oophp";

        $this->app->view->add("account/account-login");

        return $this->app->page->render([
           "title" => $title,
        ]);
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/echo Anax\View\url('here');
     * ANY METHOD mountpoint/index
     *
    * @return object
    */
    public function loginAction() : object
    {
        $title = "Login | oophp";
        $request = $this->app->request;
        $user = $request->getPost("user");
        $pass = $request->getPost("password");

        $acc = new Account();

        $success = $acc->doLogin(esc($user),esc($pass));
        $this->app->session->set("IsLoggedIn", $success);

        if($success){
          return $this->app->response->redirect(url("account/account-user"));
        }

        return $this->app->response->redirect(url("account/account-off"));
    }


    /**
    * @return object
    */
    public function accountUserAction() : object
    {
        $title = "Welcome | oophp";


        $this->app->view->add("account/account-user");

        return $this->app->page->render([
           "title" => $title,
        ]);
    }

    /**
    * @return object
    */
    public function accountOffAction() : object
    {
        $title = "Welcome | oophp";


        $this->app->view->add("account/account-off");

        return $this->app->page->render([
           "title" => $title,
        ]);
    }
}

interface IAccount {
    public function doLogin($user,$pass);
    }

class Account implements IAccount {
  public function doLogin($user, $pass){
    if($user == "admin" && $pass == "admin") {
        return true;
    } else if($user == "doe" && $pass == "doe") {
        return true;
    }

    return false;
  }
}
