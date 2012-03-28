<?
include_once("/var/seguridad/mysql.inc.php");

/* Trabajaremos con tabla2 en lugar de tabla1, ya que tabla2 trata */
/* el dni como clave primaria, evitando repeticiones de registros  */
$mysql_db    = "practicas";
$table       = "tabla2";

/* Conexión con el servidor de base de datos */
$link = mysql_connect($mysql_host, $mysql_user, $mysql_passwd)
        or die("Error en la conexión: ".mysql_error());

mysql_select_db ($mysql_db, $link);

echo "<html>";
echo "<head>"; 
echo "<title>Formulario ejercicio 43</title>";
echo "</head>"; 
echo "<body>";

echo "<form name='ejercicio43' method='POST' action='script43.php'>";
echo "<table align='center' frame='box' bgcolor='#F0FFFF'>";

/* Consultamos tabla2 para presentar en el formulario desplegables */
/* con los dni y los nombres de los alumnos dados de alta en la BD */
/* Los select de los desplegables van dentro de celdas de la tabla */

$query = "SELECT * FROM ".$table;
$result = mysql_query($query, $link);

if($result) {
   echo "<tr><td colspan='2'>";
   echo "<select>";
   echo "<option value=''>Seleccionar alumno</option>";

   while($fila = mysql_fetch_array($result, MYSQL_ASSOC)) {
      $option  = "<option value='".$fila['dni']."'>";
      $option .= $fila['apellido1']." ";
      $option .= $fila['apellido2'].", ";
      $option .= $fila['nombre']."</option>"; 
      echo $option;
   }

   echo "</select>";
   echo "</td></tr>";

   /* Liberar recursos cuando ya no son necesarios */
   mysql_free_result($result);
}

/* fila vacía en la tabla, por cuestiones estéticas */
echo "<tr><td colspan='2' style='height: 20;'></td></tr>";

/* Botón de envío en una celda de la tabla */
echo "<tr>";
echo "<td>Modificar datos</td>";
echo "<td><input type='submit' name='Enviar' value='OK'/></td>";
echo "</tr>";
echo "</table>";
echo "</form>";
echo "</body>";
echo "</html>";

mysql_close($link);
?>
