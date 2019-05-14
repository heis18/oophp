<?php
 namespace Anax\View;
 
?>

<!-- <h4>Du måste vara inloggad på sidan för att använda funktionen</h4> -->

<form method="post">
  <fieldset class="search-movie">
    <legend></legend>

    <h2>Select a movie</h2>

    <p>
        <label>Movie:<br>
        <select name="movieId">
            <option value="">Select movie...</option>
            <?php foreach ($movies as $movie) : ?>
            <option value="<?= $movie->id ?>"><?= $movie->title ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    </p>

    <p>
        <input type="submit" name="doAdd" value="Add">
        <input type="submit" name="doEdit" value="Edit">
        <input type="submit" name="doDelete" value="Delete">
    </p>
    </fieldset>

    <a class="movie-link" href="index">Show all</a>

</form>
