<?php
namespace Anax\View;

?>

<article>
    <header>
        <h1><?= esc($content->getContentTitle()) ?></h1>
        <p><i>Latest update: <time datetime="$content->getUpdatedISO()" pubdate><?= $content->getUpdatedFormatted()?></time></i></p>
    </header>
    <?= $content->getFormattedContent() ?>
</article>
