<?php 

    $estils_registre = "";
    $estil_css = "../css/processa.css";

    if (isset($_POST['estils_registre'])) {
        if ($_POST['estils_registre'] == 'morat') {
            $estil_css = "../css/estilsregistre1.css";
        } elseif ($_POST['estils_registre'] == 'groc') {
            $estil_css = "../css/estilsregistre2.css";
        }
    }

?>

<!DOCTYPE html>
<html lang="es">
<html>
	<head>
        <meta charset="utf-8">
		<title>Proyecto Entornos</title>
        <link rel="stylesheet" href="<?php  echo $estil_css; ?>">
        </head>
	<body id = "wrapper">
    <?php

        include_once ("./cap.partial.php");

    
        $base = "../";
        include_once("menu.partial.php");
    
                
        echo '<div id="registre">';

            echo '<h2>Dades Missatge Registre</h2>';

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
                if (isset($_POST['contrasenya']) && strlen(trim($_POST['contrasenyna']))> 0){
                $contrasenya=trim(htmlspecialchars($_POST['contrasenya']));
                }

                echo '<div class="seccion_formulario"
                    <label><span class="rojo">Contrasenya:</span>  <span class="gris">'.$contrasenya.'</span></label>
                </div>';


                $poblacio ="Sense valor";
                
                if (isset($_POST['poblacio'])&& strlen(trim($_POST['poblacio']))> 0){
                $poblacio=trim(htmlspecialchars($_POST['poblacio']));
                $foto = $poblacio;
                } else {
                    $foto="vacio";                   
                }

                echo '<div class="seccion_formulario"
                    <label><span class="rojo">Poblacio:</span>  <span class="gris">'.$poblacio.'</span></label>
                    <img src="../img/'.$foto.'.jpg" alt="poblacio">
                </div>'; 
                

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

                $estils_registre ="Sense valor";
                if (isset($_POST['estils_registre'])&& strlen(trim($_POST['estils_registre']))> 0){
                $estils_registre=trim(htmlspecialchars($_POST['estils_registre']));
                }

                echo '<div class="seccion_formulario"
                <label><span class="rojo">Estils registres:</span>  <span class="gris">'.$estils_registre.'</span></label>
                </div>';

    

                echo '</div>';

            echo '</div>';
        
        echo '</div>';


        include_once ("./peu.partial.php");
                
    ?>
	</body>
</html>