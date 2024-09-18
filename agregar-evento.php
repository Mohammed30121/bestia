<html>
<!-- formulario para agregar un evento -->
<form action = '<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' method = 'post'>
    <label>nombre del evento</label><br>
    <input type = 'text' name = 'NomEvt' required><br>
    <label>lugar del evento</label><br>
    <input type = 'text' name = 'lugar' required><br>
    <label>fecha del evento</label><br>
    <input type = 'date' name = 'fecha' required><br>
    <label>hora del evento</label><br>
    <input type = 'time' name = 'hora' required><br>
    <label>limite de personas</label><br>
    <input type = 'counter' name = 'limite' require><br>
    <label>precio de entrada</label><br>
    <input type = 'counter' name = 'precio' required><br>
    <label>atractivo o especificaciones (opcional)</label><br>
    <textarea name = 'especificaciones'></textarea><br>
    <button>Subir</button>
</form>
</html>



<?php
//conexion a la base de datos
include_once 'conexion.php'; 
$conn = conexion($servername, $username, $password,$db);

//conexion a las funciones y llamada a la funcion alta de eventos
require 'funciones.php';
altaEvt($conn);
?>