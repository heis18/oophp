<?php
 namespace Anax\View;

?>

<form method="get">
    <fieldset class="search-movie">
    <legend></legend>
    <input type="hidden" name="route" value="search-title">

    <h2>Search for a movie by title</h2>

    <p>
        <label>Title (use % as wildcard):
          <br>
            <input type="search" name="searchTitle" value="<?= esc($searchTitle) ?>"/>
        </label>
    </p>

    <p>
        <input class="search" type="submit" name="doSearch" value="Search">
    </p>
    </fieldset>

        <a class="movie-link" href="index">Show all</a>
</form>
