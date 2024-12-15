<main id="contacte">

<h2>Contacte</h2>

<div id="formulario">
    <form method="post" action="include/processaContacte.php">
        <div class="seccion_formulario">
            <label for="correu_electronic">Correu Electrónic:</label> 
            <input class="input" type="text" name="correu_electronic" required/>
        </div>  
        
        <div class="seccion_formulario">
            <label for="assumpte">Assumpte:</label> 
            <input class="input" type="text" name="assumpte" required>
        </div>

        <div class="seccion_formulario">
            <label for="missatge">Missatge:</label> 
            <textarea class="input" id="missatge" name="missatge" cols="40" rows="4"></textarea>
        </div>
            
        <button type = "submit">Enviar</button>

        <button type="reset">Neteja</button>
        
    </form>
</div>

</main>
