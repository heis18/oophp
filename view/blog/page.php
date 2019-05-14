<?php
namespace Anax\View;

?>

<article>
    <header>
        <h1><?= esc($content->getContentTitle()) ?></h1>
        <p><i>Latest update: <time datetime=" esc($content->modified_iso8601) " pubdate> esc($content->modified) </time></i></p>
    </header>
    <?= esc($content->getContentData()) ?>
</article>
