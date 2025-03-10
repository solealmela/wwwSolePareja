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
        }else{
            $color = "per defecte";
        }

        if (isset($_SESSION["usuari"])) {
            setcookie($_SESSION["usuari"], $color, time() + (30 * 24 * 60 * 60), "/");
        }
	}

	if (isset($_POST["contrasenya"]) && isset($_POST["contrasenya"])) {
		$contrasenya = $_POST["contrasenya"];
		$confirmar_contrasenya = $_POST["confirmar_contrasenya"];

		if ($contrasenya != $confirmar_contrasenya) {
		header("Location: ../index.php?apartat=registre&errorRegistre=contrasenyes");
		die();
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
			$base = "../";
            $estil_css = "css/processa.css";


            if (!empty($_SESSION["estils"])){
                $estil_css = $_SESSION["estils"];
            }
	
			$estil_css = $base.$estil_css;
		?>
		<link rel="stylesheet" href="<?php echo $estil_css; ?>">

    </head>
	<body id = "wrapper">
    <?php

        include_once ("./cap.partial.php");
    
        include_once("./menu.partial.php");
                
        echo '<div id="registre">';

            echo '<h2>Dades Missatge Registre</h2>';

			include_once("funcions.php");

			$fitxer_usuaris = "../usuaris/passwd.txt";

			$nom = $_POST['nom'] ?? '';
			$email = $_POST['correu_electronic'] ?? '';
			$contrasenya = $_POST['contrasenya'] ?? '';
			
			$registreExit = guardarUsuari($nom, $email, $contrasenya, $fitxer_usuaris);
			missatge($registreExit, $email);

            echo '<div id="formulario">';

                echo '<div id="interior_formulario">';
                
					$nom ="Sense valor";
					if (isset($_POST['nom'] ) && strlen(trim($_POST['nom']))> 0){
						$nom=trim(htmlspecialchars($_POST['nom']));
					}
					
					echo '<div class="seccion_formulario"
						<label><span class="rojo">Nom:</span>  <span class="gris">'.$nom.'</span></label>
					</div>';

					$cognoms ="Sense valor";
					if (isset($_POST['cognoms'])&& strlen(trim($_POST['cognoms']))> 0){
						$cognoms=trim(htmlspecialchars($_POST['cognoms']));
					}

					echo '<div class="seccion_formulario"
						<label><span class="rojo">Cognoms:</span>  <span class="gris">'.$cognoms.'</span></label>
					</div>';

					$adreça ="Sense valor";
					if (isset($_POST['adreça']) && strlen(trim($_POST['adreça']))> 0){
						$adreça=trim(htmlspecialchars($_POST['adreça']));
					}

					echo '<div class="seccion_formulario"
						<label><span class="rojo">Adreça:</span>  <span class="gris">'.$adreça.'</span></label>
					</div>';


					$correu_electronic ="Sense valor";
					if (isset($_POST['correu_electronic'])&& strlen(trim($_POST['correu_electronic']))> 0){
						$correu_electronic=trim(htmlspecialchars($_POST['correu_electronic']));
					}

					echo '<div class="seccion_formulario"
						<label><span class="rojo">Correu electrónic:</span>  <span class="gris">'.$correu_electronic.'</span></label>
					</div>';
					
					$contrasenya ="Sense valor";
					if (isset($_POST['contrasenya']) && strlen(trim($_POST['contrasenya']))> 0){
						$contrasenya=trim(htmlspecialchars($_POST['contrasenya']));
					}

					echo '<div class="seccion_formulario"
						<label><span class="rojo">Contrasenya:</span> <span class="gris">'.$contrasenya.'</span></label>
					</div>';

					$confirmar_contrasenya="Sense valor";

					if (isset($_POST['confirmar_contrasenya']) && strlen(trim($_POST['confirmar_contrasenya']))> 0){
						$contrasenya=trim(htmlspecialchars($_POST['confirmar_contrasenya']));
					}

					echo '<div class="seccion_formulario"
					<label><span class="rojo">Confirmar contrasenya:</span> <span class="gris">'.$confirmar_contrasenya.'</span></label>
					</div>';

					include 'dades.php';

					$poblacio = "Sense valor";
					$foto = "vacio";

					if (isset($_POST['poblacio']) && strlen(trim($_POST['poblacio'])) > 0) {
						$poblacio = trim(htmlspecialchars($_POST['poblacio']));
						$foto = $poblacio;
					}

					echo '<div class="seccion_formulario">
							<label><span class="rojo">Població:</span> <span class="gris">' . $poblacio . '</span></label>
							<img src="../img/' . $foto . '.jpg" alt="població">
						</div>';

					if (isset($dadesPoblacions[$poblacio])) {
						$dades = $dadesPoblacions[$poblacio];
						echo '<div class="seccion_formulario">';
						echo '<table id = "tabla">';
						echo '<tr><th colspan = "2">Dades de la Població</th></tr>';
						foreach ($dades as $camp => $valor) {
							echo '<tr><td class="campo">' . ucfirst($camp) . '</td><td>' . htmlspecialchars($valor) . '</td></tr>';
						}
						echo '</table>';
						echo '</div>';
					} 
					

					$telefon ="Sense valor";
					if (isset($_POST['telefon']) && strlen(trim($_POST['telefon']))> 0){
						$telefon=trim(htmlspecialchars($_POST['telefon']));
					}

					echo '<div class="seccion_formulario"
						<label><span class="rojo">Teléfon:</span>  <span class="gris">'.$telefon.'</span></label>
					</div>';

					$horari ="Sense valor";
					if (isset($_POST['horari'])&& strlen(trim($_POST['horari']))> 0){
						$horari=trim(htmlspecialchars($_POST['horari']));
					}

					echo '<div class="seccion_formulario"
						<label><span class="rojo">Hora repartiment:</span>  <span class="gris">'.$horari.'</span></label>
					</div>';


					$fruites_preferides = [];

					if (isset($_POST['fruites_preferides']) && is_array($_POST['fruites_preferides'])) {
						$fruites_preferides = $_POST['fruites_preferides'];
					}

					echo '<div class="seccion_formulario">
							<label><span class="rojo">Fruites preferides:</span></label>';

						if (!empty($fruites_preferides)) {
							foreach ($fruites_preferides as $fruita) {
								echo '<img src="../img/' . $fruita . '.png"/>';
							}
						} else {
							echo '<img src="../img/vacio.jpg"/>';
						}

					echo '</div>';	


                	echo '</div>';

            echo '</div>';
        
        echo '</div>';


        include_once ("./peu.partial.php");
                
    ?>
	</body>
</html>