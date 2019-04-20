<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?>

<div class="game100">

<h1>Spela tärningsspelet först till 100!</h1>


<div class= "players">

<h4><b>Spelare och poäng i pågående spel:</b></h4>
<p> Spelare 1 :
   <!-- <b><?= $who ?> points</b> -->
 </p>
<p> Spelare 2 :
  <!-- <b><?= $who ?> points</b> -->
</p>

</div>



<div class= "dices">
<h4><b>Aktivt tärningskast!</b></h4>
<p> Värdet i aktiva tärningar: ... </p>
<p> Summan av aktiva tärningar: ... </p>

</div>



<form class = "game" method="post">
      <input type="submit" name="roll" value="Slå Tärningar">
      <input type="submit" name="save" value="Spara Summan">

      <input type="submit" name="roll" value="Nästa spelare">

      <input type="submit" name="reseat" value="Starta om">
</form>


</div>
