<?php

namespace Anax\View;

?>

<h1>Welcome <?=$user->getName()?></h1>

<p>You can now do changes in the database!</p>

<p>You can add a new movie, edit an existing moveie or delete an existing movie.</p>
<a href="<?= url("movie/movieselect") ?>">Select</a>

<p>You can allso reset the entire database if that will ever be nessesary.</p>
<a href="<?= url("movie/moviereset") ?>">Reset database</a>
