<?php
 namespace Anax\View;

?>

<?php if (isset($message)) : { ?>
  <div><?= $message ?></div>
    <?php
    }
endif;
?>

<form method="post" action="<?= url("blog/update") ?>">
  <fieldset class="search-movie">
    <legend>Edit</legend>
    <input type="hidden" name="contentId" value="<?= esc($blog->getId()) ?>"/>


    <p>
        <label>Title:<br>
        <input type="text" name="contentTitle" value="<?= esc($blog->getContentTitle()) ?>"/>
        </label>
    </p>

    <p>
        <label>Path:<br>
        <input type="text" name="contentPath" value="<?= esc($blog->getContentPath()) ?>"/>
    </p>

    <p>
        <label>Slug:<br>
        <input type="text" name="contentSlug" value="<?= esc($blog->getContentSlug()) ?>"/>
    </p>

    <p>
        <label>Text:<br>
        <textarea name="contentData"><?= esc($blog->getContentData()) ?></textarea>
     </p>

     <p>
         <label>Type:<br>
         <input type="text" name="contentType" value="<?= esc($blog->getContentType()) ?>"/>
     </p>

     <p>
         <label>Filter:<br>
         <input type="text" name="contentFilter" value="<?= esc($blog->getContentFilter()) ?>"/>
     </p>

     <p>
         <label>Publish:<br>
         <input type="datetime" name="contentPublish" value="<?= esc($blog->getContentPublish()) ?>"/>
     </p>

    <p>
        <button type="submit" value="doSave" name="doSave"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
        <button type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
        <button type="submit" name="doDelete" value="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
    </p>
    </fieldset>
</form>
