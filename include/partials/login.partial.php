<?php
    if (!isset($_SESSION["usuari"])) {
        echo '<div id="form_login">
        <form method="post" action="include/processaLogin.php">
            <label id="palabra_login">Login</label>
            <div id="seccion_login">
                <label for="correu">Correu: *</label> 
                <input class="input" type="text" name="correu" required/>
            
                <label for="contrasenya">Contrasenya: *</label> 
                <input class="input" type="password" name="contrasenya" required>

                <button type = "submit">Entra</button>       
            </div>
        </form>';
        include_once("include/funcions.php");
        if (isset($_GET["error"])) {
            missatgeErrorLogin($_GET["error"]);
        }
        echo '</div>';   
    }
?>