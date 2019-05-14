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
class DatabaseReset
{
      /**
    * @return object
    */
    public function resetDatabase($fileName) : object
    {
        $title = "Reset database | oophp";
        $sqlCommands = [];

        $sqlText = file_get_contents($fileName);

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
