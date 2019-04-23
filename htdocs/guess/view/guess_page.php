<h1>Guess the number with POST</h1>
<hr>
<p>Guess the number between 1 - 100</p><br><br>
<?php 
echo $triesLeft . '<br><br>';
echo $gissning . '<br><br>'; 
echo $message . '<br><br>';
?>

<form method="post" action="./processing_page.php">
    <input type="text" name="gissning">
    <input type="submit" name="gissa" value="Guess">
    <input type="submit" name="reset" value="Reset">
    <input type="submit" name ="fuska" value="Cheat">
</form>