<?php

namespace Anax\View;

if (!$resultset) {
    return;
}
?>

<article>

<?php foreach ($resultset as $row) : ?>
<section>
    <header>
        <h1><a href="<?= url("blog/blogpost")?>?route=slug/<?= $row->getContentSlug() ?>"><?= $row->getContentTitle(); ?></a></h1>
        <p><i>Published: <time datetime="<?=$row->getContentPublish() ?>" pubdate><?= $row->getContentPublishFormatted() ?></time></i></p>
    </header>
    <?= $row->getFormattedContent() ?>
</section>
<?php endforeach; ?>

</article>
