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
        <!-- <h1><a href="?route=blog/<?= esc($row->slug) ?>"><?= esc($row->title) ?></a></h1> -->
        <!-- <p><i>Published: <time datetime="<?= esc($row->published_iso8601) ?>" pubdate><?= esc($row->published) ?></time></i></p> -->
    </header>
    <?= esc($row->getContentData()) ?>
</section>
<?php endforeach; ?>

</article>
