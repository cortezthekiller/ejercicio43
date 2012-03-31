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

/* El formulario inicial manda los datos a este mismo script */
/* Comprobar si anteriormente se ha elegido a un alumno en el formulario */ 
if(isset($_POST['enviar']) && $_POST['alumno']) {

   /* Mostrar los datos del alumno seleccionado */
   echo "<form name='modificar_datos' method='POST' action='script43.php'>";
   echo "<table align='center' border='1' bgcolor='#F0FFFF'>";
   echo "<tr>";
   echo "<th>DNI</th>";
   echo "<th>Primer apellido</th>";
   echo "<th>Segundo apellido</th>";
   echo "<th>Nombre</th>";
   echo "<th>Fecha de nacimiento</th>";
   echo "<th>Repetidor</th>";
   echo "</tr>";

   echo "<tr>";
   $query  = "SELECT * from ".$table." WHERE dni='".$_POST['alumno']."'";
   $result = mysql_query($query, $link);

   /* Como sólo esperamos un registro en el result no hacemos */
   /* fetch sino que lo obtendremos con mysql_result().       */
   /* El DNI será 'fijo' y permitiremos editar el resto de campos */
 
   /* Pasaremos el dni en un input hidden (no modificable) */
   $input  = "<input type='hidden' name='dni' value='";
   $input .= mysql_result($result, 0, 0)."'/>"; 
   echo "<td>".mysql_result($result, 0, 0).$input."</td>"; /* dni */
   
   /* El resto de campos van en un input de tipo text (editables) */
   $input  = "<input type='text' name='apellido1' value='";
   $input .= mysql_result($result, 0, 2)."'/>";
   echo "<td>".$input."</td>"; /* apellido1 */
   $input  = "<input type='text' name='apellido2' value='";
   $input .= mysql_result($result, 0, 3)."'/>";
   echo "<td>".$input."</td>"; /* apellido2 */
   $input  = "<input type='text' name='nombre' value='";
   $input .= mysql_result($result, 0, 1)."'/>";
   echo "<td>".$input."</td>"; /* nombre */


   /* Extraer el dia, mes y año del campo fecha_nac (tipo DATE)    */
   /* $fecha[0] = year, $fecha[1] = month, $fecha[2] = day         */
   $fecha = explode("-", mysql_result($result, 0, 4));

   /* Mostrar tres desplegables para el día, mes y año de nacimiento.  */
   /* En los desplegables aparecerá por defecto la fecha de nacimiento */
   /* del alumno seleccionado (atributo 'selected' del option.         */
   $select_day = "<select name='day'>";

   for($day=1; $day<32; $day++) {
      if($day == $fecha[2])
         $select_day .= "<option selected='selected'>".$day."</option>";
      else
         $select_day .= "<option>".$day."</option>";
   }
   $select_day .= "</select>";
   
   $select_month = "<select name='month'>";

   for($month=1; $month<13; $month++) {
      if($month == $fecha[1])
         $select_month .= "<option selected='selected'>".$month."</option>";
      else
         $select_month .= "<option>".$month."</option>";
   }
   $select_month .= "</select>";

   $select_year = "<select name='year'>";

   for($year=1960; $year<2013; $year++) {
      if($year == $fecha[0])
         $select_year .= "<option selected='selected'>".$year."</option>";
      else
         $select_year .= "<option>".$year."</option>";
   }
   $select_year .= "</select>";

   /* Select para día-mes-año de nacimiento */
   echo "<td>".$select_day."de".$select_month."del".$select_year."</td>";

   /* Input para el campo 'repetidor' */
   $input  = "<input type='text' name='repetidor' value='";
   $input .= mysql_result($result, 0, 5)."'/>";
   echo "<td>".$input."</td>"; /* repetidor */
   echo "</tr>";
   echo "</table>";

   /* Botones para submitir el action a 'script43.php' */
   echo "<p style='text-align: center;'>Guardar los cambios&nbsp";
   echo "<input type='submit' name='ok' value='OK'/>";
   echo "<input type='submit' name='cancel' value='Cancel'/></p>";
   echo "</form>";
   echo "</body>";
   echo "</html>";

   mysql_free_result($result);
   mysql_close($link);
   exit();
}

/* La primera vez que se llame a este archivo empezaremos aquí */

echo "<form name='mostrar_datos' method='POST' action=''>";
echo "<table align='center' frame='box' bgcolor='#F0FFFF'>";

/* Consultamos tabla2 para presentar en el formulario desplegables */
/* con los dni y los nombres de los alumnos dados de alta en la BD */
/* Los select de los desplegables van dentro de celdas de la tabla */

$query = "SELECT * FROM ".$table;
$result = mysql_query($query, $link);

if($result) {
   echo "<tr><td colspan='2'>";
   echo "<select name='alumno'>";
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
echo "<td>Mostrar datos</td>";
echo "<td><input type='submit' name='enviar' value='OK'/></td>";
echo "</tr>";
echo "</table>";
echo "</form>";
echo "</body>";
echo "</html>";

mysql_close($link);
?>
