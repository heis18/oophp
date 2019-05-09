<?php
namespace Heis\Account;

interface IAccount
{
    public function doLogin($user, $pass);
}
