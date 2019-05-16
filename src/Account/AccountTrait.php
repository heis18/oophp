<?php

namespace Heis\Account;

trait AccountTrait
{
    public function isLoggedIn()
    {
        return $this->app->session->get("isLoggedIn") != null;
    }

    public function getUser()
    {
        return $this->app->session->get("isLoggedIn");
    }
}
