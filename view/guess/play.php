<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>Guess the number with POST</h1>
<p>Guess the number between 1 - 100</p><br><br>
<?php
echo 'You have <b>' . $tries . '</b> tries left<br><br>';
if ($guess) {
    echo 'Your guess <b>' . $guess . '</b> is ...<br><br>';
}
echo '<b>' . $res . '</b><br><br>';
?>

<form method="post" action="./play">
    <input type="text" name="gissning">
    <input type="submit" name="gissa" value="Guess">
    <input type="submit" name="reset" value="Reset">
    <input type="submit" name ="fuska" value="Cheat">
</form>
<!-- <form method="post" action="./reset">
    <input type="submit" name="doInit" value="reset">
</form> -->