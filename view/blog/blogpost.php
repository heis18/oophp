<?php
namespace Anax\View;

?>

<article>
    <header>
        <h1><?= esc($content->getContentTitle()) ?></h1>
        <!-- <p><i>Published: <time datetime="<?= esc($content->published_iso8601) ?>" pubdate><?= esc($content->getContentPublish()) ?></time></i></p> -->
    </header>
    <?= esc($content->getContentData()) ?>
</article>
