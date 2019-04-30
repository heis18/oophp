<?php

/**
 * @author Helena Isåfjäll <heis18@student.bth.se>
 */

namespace Anax\View;

use Heis\Dice\DiceHandGraphic;
use Heis\Dice\Histogram;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

$board = $data["board"];
$p1 = $board->getPlayer1();
$c1 = $board->getComputer();
$currentPlayer = $board->getCurrentPlayer();
?>

<div class="game100">

<h1>Spela tärningsspelet först till 100! (1)</h1>


<div class="game100Buttons">

<?php if ($board->getWinner() == null) : ?>
    <?php if ($board->getCurrentPlayer() == $p1 && $currentPlayer->isHandValid($currentPlayer->currentHand())) : ?>
<form class = "roll" method="post" action="roll">
      <input type="submit" name="roll" value="Slå Tärningar">
</form>
    <?php endif;?>

<form class = "next" method="post" action="next">
      <input type="submit" name="next" value="Spara och byt spelare">
</form>
<?php endif;?>

<form class = "init" method="get" action="init">
      <input type="submit" name="init" value="Starta om">
</form>
</div>



<div class="winner">
    <?php if ($board->getWinner() != null) : ?>
    <h2> Vinnare av spelet är: <?= $board->getWinner()->getName(); ?> </h2>
    <?php endif;?>

</div>



<div class= "dices">
    <?php
    $p1g = new DiceHandGraphic($currentPlayer->currentHand());
    ?>

<h4><b>Aktivt tärningskast i omgång <?= $board->getRound();?></b></h4>
<p> Aktiva tärningar:  <?= $p1g->graphic(); ?></p>
<p> Summan av aktiva tärningar: ... <?= $currentPlayer->currentHand()->sum() ?></p>

</div>


<div class="histogram">

<div class="histogram-p1">
  <h4>Player 1</h4>
<?php
$p1His = new Histogram();
$p1His->injectData($p1);?>
<pre><?= $p1His->getAsText() ?></pre>
</div>

<div class="histogram-c1">
  <h4>Computer</h4>
<?php
$c1His = new Histogram();
$c1His->injectData($c1); ?>
<pre><?= $c1His->getAsText() ?></pre>
</div>

</div>



<div class= "players">
<h4><b>Poäng i pågående spel:</b></h4>

<table class="gametable">
    <tr>
      <td> Omgång
      </td>
      <td> <?= $p1->getName() ?></td>
      <td> <?= $c1->getName() ?> </td>
    </tr>

<?php for ($i=0; $i<$board->getRound(); $i++) { ?>
    <?php
    $p1Hand = $p1->getHand($i);
    $c1Hand = $c1->getHand($i);
    ?>

    <tr>
        <td><?= $i+1 ?></td>
        <td><?= $p1Hand == null ? "&nbsp;" : $p1->sumHand($p1Hand); ?>  </td>
        <td><?= $c1Hand == null ? "&nbsp;" : $c1->sumHand($c1Hand); ?>  </td>
    </tr>
<?php };?>
    <tr>
      <td>Totalsumma:</td>
      <td><?= $p1->sumResult() ?></td>
      <td><?= $c1->sumResult() ?></td>
    </tr>

</table>
</div>





</div>
