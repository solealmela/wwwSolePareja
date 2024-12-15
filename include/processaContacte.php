<!DOCTYPE html>
<html lang="es">
<html>
	<head>
        <meta charset="utf-8">
		<title>Proyecto Entornos</title>
		<link rel="stylesheet" href="../css/processa.css">
	</head>
	<body id = "wrapper">
    <?php

        include_once ("./cap.partial.php");

    
        $base = "../";
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
                if (isset($_POST['assumpte']) && strlen(trim($_POST['correu_electronic']))> 0){
                    $assumpte=trim(htmlspecialchars($_POST['assumpte']));
                }

                echo '<div class="seccion_formulario"
                    <label><span class="rojo">Assumpte:</span>  <span class="gris">'.$assumpte.'</span></label>
                </div>';


                $missatge ="";
                if (isset($_POST['missatge']) && strlen(trim($_POST['correu_electronic']))> 0){
                $missatge=trim(htmlspecialchars($_POST['missatge']));
                }

                echo '<div class="seccion_formulario"
                <label><span class="rojo">Missatge:</span>  <span class="gris">'.$missatge.'</span></label>
                </div>';

                $img = "";
                $puntuacio ="Sense valor";
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
                }

                echo '<div class="seccion_formulario"
                <label><span class="rojo">Puntuació:</span>  <span id="sensevalor_puntuacio">'.$puntuacio.'</span></label>';
                for ($i = 0; $i < $puntuacio; $i++){
                    echo '<img src="../img/'.$img.'.png" class="puntuacio">';
                }
                
                echo '</div>';
                
                echo '</div>';

            echo '</div>';
        
        echo '</div>';


        include_once ("./peu.partial.php");
                
    ?>
	</body>
</html>