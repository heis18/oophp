<?php

namespace Heis\Account;

class Account implements IAccount
{
    private $userId;
    private $pass;
    private $userName;

    public function __construct($userId = "", $pass = "", $name = "")
    {
        $this->userId = $userId;
        $this->pass = $pass;
        $this->userName =$name;
    }

    public function doLogin($user, $pass)
    {
        if ($user == "admin" && $pass == "admin") {
            return $this->getUser($user);
        } else if ($user == "doe" && $pass == "doe") {
            return $this->getUser($user);
        }

        return null;
    }

    public function getUser($user)
    {
        if ($user == "admin") {
            return new Account("admin", "admin", "Admin almighty Isåfjäll.");
        }

        if ($user == "doe") {
            return new Account("doe", "doe", "Doooeee");
        }

        return null;
    }

    public function getName()
    {
        return $this->userName;
    }

    public function getUserId()
    {
        return $this->userid;
    }
}
