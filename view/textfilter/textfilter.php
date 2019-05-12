<?php

namespace Anax\View;

?>

<h1>Showing off Different textfilter</h1>

<h2>Raw text, with no formatting</h2>
<pre><?= $text ?></pre>

<h2>Text formatted with bbcode2html, source</h2>
<pre><?= wordwrap(htmlentities($text1)) ?></pre>

<h2>Text formatted with makeClickable, source</h2>
<pre><?= wordwrap(htmlentities($text2)) ?></pre>

<h2>Text formatted with markdown, source</h2>
<pre><?= wordwrap(htmlentities($text3)) ?></pre>

<h2>Text formatted with nl2br, source</h2>
<pre><?= wordwrap(htmlentities($text4)) ?></pre>

<h2>Text displayed on webbsite, source</h2>
<pre><?= wordwrap(htmlentities($text5)) ?></pre>

<h2>Text displayed on webbsite</h2>
<?= $text6 ?>
