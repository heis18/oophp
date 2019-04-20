<?php

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

  ?>

    <tr>

        <td><?= $i+1 ?></td>
        <td><?= $p1Hand == null ? "Inget resultat." : $p1Hand->sum(); ?>  </td>
        <td><?= $c1Hand == null ? "Inget resultat." : $c1Hand->sum(); ?>  </td>

    </tr>
DiceHandGraphic
  <?php }; ?>

</table>


<div class="winner">
  <?php if ($board->getWinner() != null): ?>

    <p> Vinnare av spelet är: <?= $board->getWinner()->getName(); ?> </p>

  <?php endif; ?>

</div>

</div>


<?php
 $p1g = new DiceHandGraphic($p1->currentHand());
?>

<div class= "dices">
<h4><b>Aktivt tärningskast i omgång <?= $board->getRound();?></b></h4>

<p> Värdet i aktiva tärningar: ... <?= $p1g->graphic(); ?></p>
<p> Summan av aktiva tärningar: ... <?= $p1->currentHand()->sum() ?></p>


</div>



<form class = "game" method="post" action="roll">
      <input type="submit" name="roll" value="Slå Tärningar">
</form>

<form class = "game" method="post" action="save">
      <input type="submit" name="save" value="Spara Summan">
</form>

<form class = "game" method="post" action="player2">
      <input type="submit" name="player2" value="Nästa spelare">
</form>

<form class = "game" method="get" action="init">
      <input type="submit" name="init" value="Starta om">
</form>


</div>
