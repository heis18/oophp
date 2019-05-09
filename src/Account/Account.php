<?php

namespace Heis\Account;

class Account implements IAccount
{

    public function doLogin($user, $pass)
    {
        if ($user == "admin" && $pass == "admin") {
            return true;
        } else if ($user == "doe" && $pass == "doe") {
            return true;
        }

        return false;
    }
}
