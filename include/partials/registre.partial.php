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
                <input class="input" type="password" name="contrasenya"/>
            </div>

            <div class="seccion_formulario">
                <label for="poblacio">Poblacio:</label>
                <select id="poblacio" name="poblacio" class="input">
                    <option value="" selected disabled>Selecciona una opción</option>
                    <option value="xativa">Xàtiva</option>
                    <option value="enguera">Enguera</option>
                    <option value="chella">Chella</option>
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

            <div class="seccion_formulario">
                <label for="estils_registre">Estils registre: </label>
                    <label><input type="radio" name="estils_registre" value="morat"> Morat</label>
                    <label><input type="radio" name="estils_registre" value="groc"> Groc</label>
            </div>

          
            <button type = "submit">Enviar</button>
            
            <button type="reset">Neteja</button>

        </form>

    </div>
</main>
