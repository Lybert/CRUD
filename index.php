<title>Proyecto CRUD</title>
                <script type="text/JavaScript">
            function borra_cliente(id) {
                var answer = confirm('¿Estás seguro que deseas borrar el cliente?');
                if (answer) {
                    // si el usuario hace click en ok, 
                    // se ejecutar borrar.php
                    window.location = 'borra.php?id=' + id;
                }
            }
        </script> 
    echo "<a href='javascript:borra_cliente(\"$id\")'> Elimina </a>";
    <?php
// incluir la conexión a la base de datos
include 'conexion.php';
// coger el parámetro que nos permitirá identificar el registro
// isset() es una función PHP usado para verificar si una variable tiene valor o no
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Registro no encontrado.');
// Consulta de borrado
$query = "DELETE FROM clientes WHERE id = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param('i', $id);
if ($stmt->execute()) {
    // después de borrar ir a index.php de nuevo e
    // informar que el archivo fue borrado
    header('Location: index.php?action=deleted');
} else {
    die('Imposible borrar el registro.');
}
?>
    header('Location: index.php?action=deleted');
    <h1>Listado de Clientes</h1>
        <?php
// incluir la conexión a la base de datos
        include 'conexion.php';
// Elegir los datos que deseamos recuperar de la tabla
        $query = "SELECT id, nif, nombre, apellido1, apellido2, email, telefono, usuario  "
                . "FROM clientes "
                . "ORDER BY apellido1, apellido2, nombre";
        if ($stmt = $conexion->prepare($query)) {
            if (!$stmt->execute()) {
                die('Error de ejecución de la consulta. ' . $conexion->error);
            }
// recoger los datos
            $stmt->bind_result($id, $nif, $nombre, $apellido1, $apellido2, $email, $telefono, 
$usuario);
// enlace a alta de cliente
            echo "<div>";
            echo "<a href='alta.php'>Alta cliente</a>";
            echo "</div>";
//cabecera de los datos mostrados
            echo "<table>"; //start table
            //creating our table heading
            echo "<tr>";
            echo "<th>NIF</th>";
            echo "<th>Nombre</th>";
            echo "<th>Apellido 1</th>";
            echo "<th>Apellido 2</th>";
            echo "<th>email</th>";
            echo "<th>telefono</th>";
                        echo "<th>usuario</th>";
            echo "</tr>";
//recorrido por el resultado de la consulta
            while ($stmt->fetch()) {
                echo "<tr>";
                echo "<td>$nif</td>";
                echo "<td>$nombre</td>";
                echo "<td>$apellido1</td>";
                echo "<td>$apellido2</td>";
                echo "<td>$email</td>";
                echo "<td>$telefono</td>";
                echo "<td>$usuario</td>";
                echo "<td>";
// Este enlace es para modificar el registro
                echo "<a href='edita.php?id={$id}'>Edita</a>";
                echo " / ";
// Este enlace es para borrar el registro y también se explicará más tarde
                echo "<a href='javascript:borra_cliente(\"$id\")'> Elimina </a>";
                echo "</td>";
                echo "</tr>\n";
            }
            // end table
            echo "</table>";
            $stmt->close();
        } else {
            die('Imposible preparar la consulta. ' . $conexion->error);
        }
        ?>
