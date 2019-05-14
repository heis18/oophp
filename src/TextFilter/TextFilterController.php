<?php

namespace Heis\TextFilter;

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
class TextFilterController implements AppInjectableInterface
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
        $title = "Textfilter | oophp";



        $text = "###Tut pip hej!
Hur mår du idag?

[b]Bra![/b]
Spana in den här sidan: https://www.etsy.com/shop/eMerakiStudio/items";

        $textfilter = new MyTextFilter();

        $filters = [
            "bbcode"    => "bbcode2html",
            "link"      => "makeClickable",
            "markdown"  => "markdown",
            "nl2br"     => "nl2br"
        ];
        $text1 = $textfilter->parse($text, [
          "bbcode"    => "bbcode2html"
        ]);

        $text2 = $textfilter->parse($text, [
          "link"      => "makeClickable"

        ]);
        $text3 = $textfilter->parse($text, [
          "markdown"  => "markdown"
        ]);

        $text4 = $textfilter->parse($text, [
          "nl2br"     => "nl2br"
        ]);

        $text5 = $textfilter->parse($text, $filters);

        $text6 = $textfilter->parse($text, $filters);

        $this->app->view->add("textfilter/textfilter", [
            "text" => $text,
            "text1" => $text1,
            "text2" => $text2,
            "text3" => $text3,
            "text4" => $text4,
            "text5" => $text5,
            "text6" => $text6,
        ]);

        return $this->app->page->render([
            "title" => $title,


        ]);
    }
}
