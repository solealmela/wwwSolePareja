<?php
if (!isset($_SESSION["usuari"])) {
    echo "<p class='mensaje-buit'>No tens sessió iniciada.</p>";
    return;
}

if (isset($_GET['error'])) {
    $missatges = [
        'pujada' => "Error en pujar la imatge.",
        'tipus' => "El fitxer no és un tipus permés (jpg, jpeg, png, gif).",
        'mida' => "El fitxer supera la mida màxima de 400KB.",
        'guardar' => "No s'ha pogut guardar la imatge.",
        'no_sessio' => "Sessió no iniciada."
    ];
    echo "<p class='error'>" . $missatges[$_GET['error']] . "</p>";
} elseif (isset($_GET['ok'])) {
    $missatgesOk = [
        'imatge' => "Imatge pujada correctament!",
        'eliminada' => "Imatge eliminada. Ara es mostra la imatge per defecte."
    ];
    echo "<p class='ok'>" . $missatgesOk[$_GET['ok']] . "</p>";
}
?>

<div id="canviImatge">
    <h2>Canvi imatge de perfil</h2>

    <div id="cambioFoto">
        <form id="formCambioFoto" action="include/processaCanviImatge.php" method="post" enctype="multipart/form-data">
            <label class="mensajeCambioFoto" for="imatge">Selecciona una imatge (jpg, jpeg, png, gif)</label><br>
            <label class="mensajeCambioFoto" for="imatge">La mida no pot ser major a 400KB</label><br>
            <input class="mensajeCambioFoto" type="file" name="imatge" id="imatge" accept=".jpg,.jpeg,.png,.gif" required><br><br>
            <button class="pujarEliminar" type="submit">Pujar imatge</button>
        </form>

        <form action="include/processaEliminaImatge.php" method="post" style="margin-top: 10px;">
            <button class="pujarEliminar" type="submit" onclick="return confirm('Segur que vols eliminar la imatge de perfil?');">Eliminar imatge de perfil</button>
        </form>
    </div>
</div>
