<?php
namespace Anax\View;

?>

<article>
    <header>
        <h1><?= esc($content->getContentTitle()) ?></h1>
        <p><i>Published: <time datetime="<?=$content->getContentPublish() ?>" pubdate><?= $content->getContentPublishFormatted() ?></time></i></p>
    </header>
    <?= $content->getFormattedContent() ?>
</article>
