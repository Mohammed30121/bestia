<?php
//conexion a la base de datos
include_once 'conexion.php';
$conn = conexion($servername, $username, $password,$db);

//BICHOP
// Función para eliminar un evento por su nombre
function eliminarEvento($nomEvent, $conn) {
    // Preparar la consulta para eliminar el evento
    $sql = "DELETE FROM eventos WHERE NomEvent = ?";

    // Preparar la sentencia
    if ($stmt = $conn->prepare($sql)) {
        // Enlazar el parámetro
        $stmt->bind_param("s", $nomEvent);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Evento eliminado exitosamente.";
        } else {
            echo "Error al eliminar el evento: " . $stmt->error;
        }

        // Cerrar la sentencia
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}


//MOHAME
//funcion para dar de alta un evento
function altaEvt($conn){
    $nom = $_POST['NomEvt'];
    $lugar = $_POST['lugar'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $limite = $_POST['limite'];
    $precio = $_POST['precio'];
    $atractivo = $_POST['especificaciones'];

    $stmt = $conn->prepare('INSERT INTO eventos(NomEvent, lugar, fecha, hora, atractivo, precio, limite)
    VALUES (:nom, :lugar, :fecha, :hora, :limite, :precio, :atractivo)');

    $stmt -> bindparam(':nom',$nom);
    $stmt -> bindparam(':lugar',$lugar);
    $stmt -> bindparam(':fecha',$fecha);
    $stmt -> bindparam(':hora',$hora);
    $stmt -> bindparam(':limite',$limite);
    $stmt -> bindparam(':precio',$precio);
    $stmt -> bindparam(':atractivo',$atractivo);

    $stmt -> execute();

    return "Ready";
}
?>