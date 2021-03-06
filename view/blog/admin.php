<?php

namespace Anax\View;

if (!$resultset) {
    return;
}
?>

<table class="all-movie">
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Type</th>
        <th>Published</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Deleted</th>
        <th>Actions</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $row->id ?></td>
        <td><?= $row->title ?></td>
        <td><?= $row->type ?></td>
        <td><?= $row->published ?></td>
        <td><?= $row->created ?></td>
        <td><?= $row->updated ?></td>
        <td><?= $row->deleted ?></td>
        <td>
            <a class="icons" href="<?= url("blog/edit?id=".$row->id) ?>" title="Edit this content">Update<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </a> |
            <a class="icons" href="<?= url("blog/delete")?>?id=<?= $row->id ?>" title="Edit this content">Delete<i class="fa fa-trash-o" aria-hidden="true"></i>
            </a>
        </td>
    </tr>
<?php endforeach; ?>
</table>
