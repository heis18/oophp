<?php

namespace Heis\Blog;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

/**
 * To ease rendering a page consisting of several views.
 */
class BlogService implements ContainerInjectableInterface, AppInjectableInterface
{
    use ContainerInjectableTrait;
    use AppInjectableTrait;


    public function doStuff()
    {
        return "NISSE";
    }
}
