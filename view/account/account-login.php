<?php
namespace Anax\View;

?>


<form method="post" action="<?= url("account/login") ?>">
    <fieldset class="search-movie">
    <legend></legend>
    <input type="hidden" name="route" value="search-title">

    <h2>Log in to do changes in the movie-database</h2>

    <p>
        <label>Username:
            <input type="text" name="user">
        </label>
    </p>
    <p>
        <label>Password:
            <input type="password" name="password">
        </label>
    </p>

    <p>
        <input class="search" type="submit" name="login" value="Login">
    </p>
    </fieldset>
</form>
