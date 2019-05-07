<form method="post">
  <fieldset class="search-movie">
    <legend></legend>

    <h2>Add or edit a movie</h2>

    <input type="hidden" name="movieId" value="<?= $movie->id ?>"/>

    <p>
        <label>Title:<br>
        <input type="text" name="movieTitle" value="<?= $movie->title ?>"/>
        </label>
    </p>

    <p>
        <label>Year:<br>
        <input type="number" name="movieYear" value="<?= $movie->year ?>"/>
    </p>

    <p>
        <label>Image:<br>
        <input type="text" name="movieImage" value="<?= $movie->image ?>"/>
        </label>
    </p>

    <p>
        <input type="submit" name="doSave" value="Save">
        <input type="reset" value="Reset">
    </p>
    </fieldset>

    <p>
        <a class="movie-link" href="movie-select">Back</a> |
        <a class="movie-link" href="index">Show all</a>
    </p>
</form>
