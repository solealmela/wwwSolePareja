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

        include_once("menu.partial.php");
    
                
        echo '<div id="contacte">';

            echo '<h2>Dades Missatge Contacte</h2>';

            echo '<div id="formulario">';

                echo '<div id="interior_formulario">';

                
                $correu_electronic ="";
                if (isset($_POST['correu_electronic']) && strlen(trim($_POST['correu_electronic']))> 0){
                $correu_electronic=trim(htmlspecialchars($_POST['correu_electronic']));
                }

                echo '<div class="seccion_formulario"
                    <label><span class="rojo">Correu electrónic:</span>  <span class="gris">'.$correu_electronic.'</span></label>
                </div>';
                
                $assumpte ="";
                if (isset($_POST['assumpte']) && strlen(trim($_POST['assumpte']))> 0){
                    $assumpte=trim(htmlspecialchars($_POST['assumpte']));
                }

                echo '<div class="seccion_formulario"
                    <label><span class="rojo">Assumpte:</span>  <span class="gris">'.$assumpte.'</span></label>
                </div>';


                $missatge ="";
                if (isset($_POST['missatge']) && strlen(trim($_POST['missatge']))> 0){
                $missatge=trim(htmlspecialchars($_POST['missatge']));
                }

                echo '<div class="seccion_formulario"
                <label><span class="rojo">Missatge:</span></label>';
                
                    $paraules = explode(" ", $missatge);

                    echo '<ul>';

                    foreach ($paraules as $paraula) {

                        $class = "normal"; 

                        if ($paraula == "Fruita" || $paraula == "Verdura") {
                            $class = "especial"; 
                        } elseif (strlen($paraula) >= 10) {
                            $class = "largo";
                        }

                        echo '<span class="' . $class . '">' . $paraula . '</span> ';
                    }

                    echo '</ul>';

                echo '</div>';

                $img = "";
                $puntuacio ="Sense valor";
                $id = "";

                if (isset($_POST['puntuacio'])&& strlen(trim($_POST['puntuacio']))> 0){

                    $puntuacio=trim(htmlspecialchars($_POST['puntuacio']));
                    switch ($puntuacio) {
                        case 1: {
                            $img = "morado";
                        }
                        break;
                        case 2: {
                            $img = "naranja";
                        }
                        break;
                        case 3: {
                            $img = "amarillo";
                        }
                        break;
                        case 4: {
                            $img = "verde";

                        }
                        break;
                        case 5: {
                            $img = "azul";
                        }
                        break;
                    }
                } else $id = 'id="sensevalor_puntuacio"';

                $multiplicador ="";
                if (isset($_POST['multiplicador']) && strlen(trim($_POST['multiplicador']))> 0){
                $multiplicador=trim(htmlspecialchars($_POST['multiplicador']));
                }

                echo '<div  id="puntuacio" class="seccion_formulario">
                <label><span class="rojo">Puntuació:</span>  <span class="gris" '.$id.'>'.$puntuacio.' * '.$multiplicador.'</span></label>';
            
                    if ($puntuacio == "Sense valor") {
                        $puntuacio = 0;
                    }

                    $puntuacio = (int)$puntuacio;
                    $multiplicador = (int)$multiplicador;

                    for ($i = 0; $i < $puntuacio * $multiplicador; $i++) {
                        echo '<img src="../img/'.$img.'.png"/>';
                    }
                
                echo '</div>';
                
                echo '</div>';

            echo '</div>';
        
        echo '</div>';


        include_once ("./peu.partial.php");
                
    ?>
	</body>
</html>