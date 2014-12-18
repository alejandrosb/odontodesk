<?php
session_start();
unset($_COOKIE["loggedin"]);
session_destroy();
echo '<script>
sessionStorage.clear();
//console.log(sessionStorage.getItem("tipo"));
window.location.href = "../index.php";
</script>';

//header("Location: ../index.php");
?>
