<?php
session_start();

$conn = mysqli_connect("localhost", "root", "1234", "netflix");

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_SESSION['usuari'])) {
        $usuari = $_SESSION['usuari'];

        // Realizar una consulta SELECT para obtener la ID del cliente
        $sql_select = "SELECT id_client FROM compte WHERE usuari = '$usuari'";
        $result_select = mysqli_query($conn, $sql_select);

        if ($result_select && mysqli_num_rows($result_select) > 0) {
            // Obtener la ID del cliente
            $row = mysqli_fetch_assoc($result_select);
            $idCliente = $row['id_client'];

            // Obtener los nuevos datos del formulario
            $nom = $_POST['nom'];
            $dni = $_POST['dni'];
            $edat = $_POST['edat'];
            $data_neix = $_POST['data_neixement'];
            $adreca = $_POST['adreça'];
            $nac = $_POST['nacionalitat'];
            $email = $_POST['email'];
            $telefon = $_POST['telefon'];
            $tarjeta = $_POST['num_tarjeta'];
            $compte = $_POST['num_compte_banc'];
          

            // Realizar la actualización en la base de datos
            $sql_update = "UPDATE clients SET nom='$nom', dni='$dni', edat=$edat, data_neixement='$data_neix', adreca='$adreca', nacionalitat='$nac', email='$email', telefon=$telefon, num_tarjeta='$tarjeta', num_compte_banc='$compte' WHERE id_client = '$idCliente'";

            $result_update = mysqli_query($conn, $sql_update);

            if ($result_update) {
                    
                echo "Datos actualizados correctamente. ID del cliente: $idCliente";
            } else {
             
                echo "Error al actualizar los datos: " . mysqli_error($conn);
            }
        } else {
          
            echo "No se encontró la ID del cliente.";
        }
    } else {
       
        echo "Debes iniciar sesión para realizar modificaciones.";
    }
}

mysqli_close($conn);
?>
