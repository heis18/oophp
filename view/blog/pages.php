<?php

namespace Anax\View;

if (!$resultset) {
    return;
}
?>

<!-- <form method="post" action="<?= url("blog/pages") ?>"> -->
<table class="all-movie">
    <tr class="first">
        <th>Id</th>
        <th>Title</th>
        <th>Type</th>
        <th>Status</th>
        <th>Published</th>
        <th>Deleted</th>
    </tr>
<?php $id = -1;

foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $row->getId() ?></td>
        <td><a href="<?= url("blog/page")?>?route=path/<?= $row->getContentPath() ?>"><?= $row->getContentTitle(); ?></a></td>
        <td><?= $row->getContentType() ?></td>
        <td><?= $row->getContentPath() ?></td>
        <td><?= $row->getContentPublish() ?></td>
        <td><?= $row->getDeleted(); ?></td>
    </tr>
<?php endforeach; ?>
</table>
<!-- </form> -->
