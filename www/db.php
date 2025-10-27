<?php
$host = '192.168.56.11';  // IP de la VM db
$port = '5432';
$dbname = 'webapp_db';
$user = 'vagrant_user';
$password = 'vagrant_pass';

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    echo "<h3>Error: No se pudo conectar a la base de datos.</h3>";
    exit;
}

$result = pg_query($conn, "SELECT id, nombre, ciudad FROM personas ORDER BY id;");

if (!$result) {
    echo "<h3>Error al ejecutar la consulta:</h3>";
    echo pg_last_error($conn);
    exit;
}


echo "<h2>Datos desde PostgreSQL</h2>";
echo "<table border='1' cellpadding='5'><tr><th>ID</th><th>Nombre</th><th>Ciudad</th></tr>";

while ($row = pg_fetch_assoc($result)) {
    echo "<tr><td>{$row['id']}</td><td>{$row['nombre']}</td><td>{$row['ciudad']}</td></tr>";
}

echo "</table>";

pg_close($conn);
?>
