<?php
include_once("include/productes.php");
session_start();

require_once("include/entity/Producte.php");
require_once("include/entity/CarretCompra.php");

// Cargar carrito de sesión o crear uno nuevo
if (isset($_SESSION['carret'])) {
    $carret = unserialize($_SESSION['carret']);
} else {
    $idUsuari = isset($_SESSION['usuari']) ? $_SESSION['usuari'] : session_id();
    $carret = new CarretCompra($idUsuari);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gestión estilos
    $_SESSION["estils"] = "";

    if (isset($_POST['estils_registre'])) {
        $color = $_POST['estils_registre'];
        if ($color == "morat") {
            $_SESSION["estils"] = "css/estilsregistre1.css";
        } elseif ($color == "groc") {
            $_SESSION["estils"] = "css/estilsregistre2.css";
        }
    } else {
        $color = "per defecte";
    }

    if (isset($_SESSION["usuari"])) {
        setcookie($_SESSION["usuari"], $color, time() + (30 * 24 * 60 * 60), "/");
    }

    // Añadir producto al carrito
    if (isset($_POST['envia'])) {
        $idProducte = $_POST['idProducte'] ?? null;
        $quantitatProducte = $_POST['quantitatProducte'] ?? 0;

        // Validar cantidad
        if ($idProducte !== null && is_numeric($quantitatProducte) && $quantitatProducte > 0) {
            
            include_once("include/entity/CredencialsBD.php");

            $servidor = "localhost";
            $usuari = CredencialsBD::USUARI;
            $contrasenya = CredencialsBD::CONTRASENYA;
            $basedades = "proyectoPHPSole";

            $conn = new mysqli($servidor, $usuari, $contrasenya, $basedades);

            if ($conn->connect_error) {
                die("Error de connexió: " . $conn->connect_error);
            }

            $stmt = $conn->prepare("SELECT nom, preu FROM producte WHERE id = ?");
            $stmt->bind_param("i", $idProducte);
            $stmt->execute();
            $stmt->bind_result($nomProducte, $preuUnitari);

            if ($stmt->fetch()) {
                $preuTotal = $preuUnitari * $quantitatProducte;

                // Guardar último producto añadido en sesión (para infoCarret.partial.php)
                $_SESSION['idProducte'] = $idProducte;
                $_SESSION['nomProducte'] = $nomProducte;
                $_SESSION['preu'] = $preuUnitari;
                $_SESSION['quantitatProducte'] = $quantitatProducte;
                $_SESSION['preuTotal'] = $preuTotal;

                $producte = new Producte($idProducte, $nomProducte, $quantitatProducte, $preuUnitari, '');

                // Añadir o actualizar producto en carrito
                $carret->afegirProducte($producte);

                // Serializar y guardar carrito actualizado en sesión
                $_SESSION['carret'] = serialize($carret);
            }

            $stmt->close();
            $conn->close();

            // Redirigir para evitar reenvío del formulario
            header("Location: index.php?apartat=botiga#botiga");
            exit();
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