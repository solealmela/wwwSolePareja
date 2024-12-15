<main id="registre">

    <h2>Registre</h2>

    <div id="formulario">
        <form method="post" action="include/processaRegistre.php">
            <div class="seccion_formulario">
                <label for="nom">Nom:</label>
                <input class="input" type="text" name="nom" required/>
            </div>

            <div class="seccion_formulario">
                <label for="cognoms">Cognoms:</label>
                <input class="input" type="text" name="cognoms"/>
            </div>
            
            <div class="seccion_formulario">
                <label for="adreça">Adreça:</label>
                <input class="input" type="text" name="adreça"/>
            </div>

            <div class="seccion_formulario">
                <label for="correu_electronic">Correu Electrónic:</label>
                <input class="input" type="text" name="correu_electronic" required/>
            </div>

            <div class="seccion_formulario">
                <label for="contrasenya">Contrasenya:</label>
                <input class="input" type="text" name="contrasenya"/>
            </div>

            <div class="seccion_formulario">
                <label for="poblacio">Poblacio:</label>
                    <select id="poblacio" name="poblacio" class="input">
                        <option value="Xàtiva">Xàtiva</option>
                        <option value="Enguera">Enguera</option>
                        <option value="Chella">Chella</option>
                    </select>
            </div>

            <div class="seccion_formulario">
                <label for="telefon">Teléfon:</label>
                <input class="input" type="tel" name="telefon"/>
            </div>

            <div class="seccion_formulario">
                <label for="horari">Hora de repartiment: </label>
                    <label><input type="radio" name="horari" value="Matí"> Matí</label>
                    <label><input type="radio" name="horari" value="Vesprada"> Vesprada</label>
            </div>

          
            <button type = "submit">Enviar</button>
            
            <button type="reset">Neteja</button>

        </form>

    </div>
</main>
