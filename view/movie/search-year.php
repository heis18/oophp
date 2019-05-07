
<form method="get">
    <fieldset class="search-movie">
    <legend></legend>
    <input type="hidden" name="route" value="search-year">

    <h2>Search for a movie by year</h2>

    <p>
        <label>Created between:
          <br>
        <input type="number" name="year1" value="<?= $year1 ?: 1900 ?>" min="1900" max="2100"/>
        -
        <input type="number" name="year2" value="<?= $year2  ?: 2100 ?>" min="1900" max="2100"/>
        </label>
    </p>
    <p>
        <input class="search" type="submit" name="doSearch" value="Search">
    </p>
    </fieldset>

    <p><a class="movie-link" href="index">Show all</a></p>

</form>
