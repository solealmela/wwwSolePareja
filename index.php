<?php
    session_start();

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION["estils"] = "";

        if (isset($_POST['estils_registre'])){
            $color = $_POST['estils_registre'];

            if ($color == "morat") {
                $_SESSION["estils"] = "css/estilsregistre1.css";
            } elseif ($color == "groc") {
                $_SESSION["estils"] = "css/estilsregistre2.css";
            }
        }
	}
?>

<!DOCTYPE html>
<html lang="es">
<html>
	<head>
        <meta charset="utf-8">
		<title>Proyecto Entornos</title>
		<?php
			$base = " ./";
            $estil_css = "css/estils.css";

            if (!empty($_SESSION["estils"])){
                $estil_css = $_SESSION["estils"];
            }
	
			$estil_css = $base.$estil_css;
		?>
		<link rel="stylesheet" href="<?php echo $estil_css; ?>">
	</head>
	<body id = "wrapper">
		<?php

        include_once ("./include/cap.partial.php");

        include_once ("./include/partials/login.partial.php");
        
        include_once ("./include/menu.partial.php");

        include_once ("./include/principal.partial.php");

		include_once ("./include/peu.partial.php");

        ?>
	</body>
</html>