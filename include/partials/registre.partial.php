<main id="registre">

    <h2>Registre</h2>

    <div id="formulario">
        <form method="post" action="include/processaRegistre.php">
            <div class="seccion_formulario">
                <label for="nom">Nom:</label>
                <input class="input" type="text" name="nom" required pattern="^[^:]+$" title="No pot contenir dos punts ( : )" />
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
                <input class="input" type="email" name="correu_electronic" required pattern="^[^:]+$" title="No pot contenir dos punts ( : )"/>
            </div>

            <div class="seccion_formulario">
                <label for="contrasenya">Contrasenya:</label>
                <input class="input" type="password" name="contrasenya" required pattern="^(?!.*:).{6,}$" title="Ha de tindre almenys 6 caràcters i no pot contenir dos punts ( : )"/>
            </div>

            <div class="seccion_formulario">
                <label for="poblacio">Població:</label>
                <select id="poblacio" name="poblacio" class="input">
                    <option value="" selected disabled>Selecciona una opción</option>
                    <option value="xativa">Xàtiva</option>
                    <option value="enguera">Enguera</option>
                    <option value="chella">Chella</option>
                </select>
            </div>

            <div class="seccion_formulario">
                <label for="telefon">Telèfon:</label>
                <input class="input" type="tel" name="telefon"/>
            </div>

            <div class="seccion_formulario">
                <label for="horari">Hora de repartiment: </label>
                    <label><input type="radio" name="horari" value="Matí"> Matí</label>
                    <label><input type="radio" name="horari" value="Vesprada"> Vesprada</label>
            </div>

            <div class="seccion_formulario">
                <label for="fruites_preferides">Fruites preferides: </label>
                <label><input type="checkbox" name="fruites_preferides[]" value="poma"> Poma</label>
                <label><input type="checkbox" name="fruites_preferides[]" value="taronja"> Taronja</label>
                <label><input type="checkbox" name="fruites_preferides[]" value="melo"> Melo</label>
                <label><input type="checkbox" name="fruites_preferides[]" value="banana"> Banana</label>
                <label><input type="checkbox" name="fruites_preferides[]" value="caqui"> Caqui</label>
            </div>

            <button type="submit">Enviar</button>
            <button type="reset">Neteja</button>
        </form>
    </div>
</main>
