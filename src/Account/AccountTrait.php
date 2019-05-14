<?php

namespace Heis\Account;

interface IAccountTrait
{
    public function IsLoggedIn();
}

trait AccountTrait
{
    public function IsLoggedIn()
    {
        return $this->app->session->get("IsLoggedIn") != null;
    }

    public function getUser()
    {
        return $this->app->session->get("IsLoggedIn");
    }
}
