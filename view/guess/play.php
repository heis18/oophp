<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?>

<div class="guess">
  
<h1>Play the game Guess Number!</h1>

<p> Guess a number from 1 and 100, you have <?= $game->tries() ?> tries left </p>

<form method="post">
    <?php if ($game->tries()> 0 && !$game->hasWon()) : ?>
      <input type="text" name="guess">
      <input type="submit" name="doGuess" value="Make a guess">
    <?php endif; ?>
      <input type="submit" name="doInit" value="Start from beginning">
      <input type="submit" name="doCheat" value="Cheat">
</form>


<?php if ($doGuess) : ?>
  <p> Your guess <?= $guess ?> is <b><?= $res ?> </b></p>
<?php endif; ?>

<?php if ($doCheat) : ?>
  <p> CHEAT Current number is <?= $game->number() ?></p>
<?php endif; ?>

</div>
