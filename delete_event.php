<?php
$id = $_POST['id'];
try {
$bdd = new PDO('mysql:host=localhost;dbname=dbodonto', 'root', 'samu1X7');
} catch(Exception $e) {
exit('Unable to connect to database.');
}
$sql = "DELETE from evenement WHERE id=".$id;
$q = $bdd->prepare($sql);
$q->execute();
?>
