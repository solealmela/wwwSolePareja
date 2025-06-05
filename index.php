<?php
    include_once ("include/productes.php");
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
        }else{
            $color = "per defecte";
        }

        if (isset($_SESSION["usuari"])) {
            setcookie($_SESSION["usuari"], $color, time() + (30 * 24 * 60 * 60), "/");
        }
	}

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['envia'])) {
            $idProducte = $_POST['idProducte'];
            $quantitatProducte = $_POST['quantitatProducte'];

            
            if (isset($productes[$idProducte])) {
                $nomProducte = $productes[$idProducte]['nom'];
                $preuUnitari = $productes[$idProducte]['preu'];
                $preuTotal = $preuUnitari * $quantitatProducte;

                $_SESSION['idProducte'] = $idProducte;
                $_SESSION['nomProducte'] = $nomProducte;
                $_SESSION['preu'] = $preuUnitari;
                $_SESSION['quantitatProducte'] = $quantitatProducte;
                $_SESSION['preuTotal'] = $preuTotal;
            }

           header("Location: index.php?apartat=botiga#botiga");
            exit();
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
    <body id="wrapper">
        <div class="main-layout">
            <div class="content-zone">
                <?php include_once("include/cap.partial.php"); ?>
                <?php include_once("include/partials/login.partial.php"); ?>
                <?php include_once("include/menu.partial.php"); ?>
                <?php include_once("include/principal.partial.php"); ?>
                <?php include_once("include/peu.partial.php"); ?>
            </div>

            <div class="carret-zone">
                <?php include_once("include/infoCarret.partial.php"); ?>
            </div>
        </div>
    </body>

</html>