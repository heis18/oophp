<?php
 namespace Anax\View;

?>

<?php if (isset($message)) : { ?>
  <div><?= $message ?></div>
    <?php
    }
endif;
?>

<form method="post" action="<?= url("blog/docreate") ?>">
  <fieldset class="search-movie">
    <legend>Edit</legend>
    <p>
        <label>Title:<br>
        <input type="text" name="contentTitle" value=""/>
        </label>
    </p>


    <p>
        <button type="submit" value="doSave" name="doSave"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
    </p>
    </fieldset>
</form>
