<?php

/**
 * @author Helena Isåfjäll <heis18@student.bth.se>
 */

namespace Anax\View;

use Heis\Dice\DiceHandGraphic;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

$board = $data["board"];
$p1 = $board->getPlayer1();
$c1 = $board->getComputer();

?>

<div class="game100">

<h1>Spela tärningsspelet först till 100!</h1>

<div class= "players">

<h4><b>Spelare och poäng i pågående spel:</b></h4>

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
    $currentPlayer = $board->getCurrentPlayer();
    ?>

    <tr>
        <td><?= $i+1 ?></td>
        <td><?= $p1Hand == null ? "Inget resultat." : $p1->sumHand($p1Hand); ?>  </td>
        <td><?= $c1Hand == null ? "Inget resultat." : $c1->sumHand($c1Hand); ?>  </td>
    </tr>
<?php };?>
    <tr>
      <td>Totalsumma:</td>
      <td><?= $p1->sumResult() ?></td>
      <td><?= $c1->sumResult() ?></td>
    </tr>


</table>


<div class="winner">
    <?php if ($board->getWinner() != null) : ?>
    <p> Vinnare av spelet är: <?= $board->getWinner()->getName(); ?> </p>
    <?php endif;?>

</div>
</div>


<?php
 $p1g = new DiceHandGraphic($currentPlayer->currentHand());




?>

<div class= "dices">
<h4><b>Aktivt tärningskast i omgång <?= $board->getRound();?></b></h4>

<p> Aktiva tärningar:  <?= $p1g->graphic(); ?></p>
<p> Summan av aktiva tärningar: ... <?= $currentPlayer->currentHand()->sum() ?></p>


</div>

<?php if ($board->getWinner() == null) : ?>
    <?php if ($board->getCurrentPlayer() == $p1 && $currentPlayer->isHandValid($currentPlayer->currentHand())) : ?>
<form class = "game" method="post" action="roll">
      <input type="submit" name="roll" value="Slå Tärningar">
</form>
    <?php endif;?>

    <?php if ($board->getCurrentPlayer() == $c1) : ?>
<form class = "game" method="post" action="player2">
      <input type="submit" name="player2" value="Dator">
</form>
    <?php endif;?>

<?php endif;?>


<form class = "game" method="post" action="next">
      <input type="submit" name="next" value="Spara och byt spelare">
</form>


<form class = "game" method="get" action="init">
      <input type="submit" name="init" value="Starta om">
</form>


</div>
