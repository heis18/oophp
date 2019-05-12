<?php
 namespace Anax\View;
?>
<div class="movie-top">
    <!-- <a href="?route=select">SELECT *</a> |
    <br> -->
    <a href="<?= url("blog/index") ?>">Show all movies</a> |
    <a href="<?= url("blog/searchtitle") ?>">Search title</a> |
    <a href="<?= url("blog/new") ?>">Create new</a> |

    <a href="<?= url("blog/admin") ?>">Edit content</a>
</div>

<h1 class="movie-head">My Fantastic blog</h1>
