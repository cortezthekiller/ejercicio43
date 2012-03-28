<?
include_once("/var/seguridad/mysql.inc.php");

/* Si se ha pulsado el botón OK actualizamos el registro */
if(isset($_POST['ok'])) {
   /* Trabajaremos con tabla2 en lugar de tabla1, ya que tabla2 trata */
   /* el dni como clave primaria, evitando repeticiones de registros  */
   $mysql_db    = "practicas";
   $table       = "tabla2";

   /* Conexión con el servidor de base de datos */
   $link = mysql_connect($mysql_host, $mysql_user, $mysql_passwd)
           or die("Error en la conexión: ".mysql_error());

   mysql_select_db ($mysql_db, $link);

   $query  = "UPDATE ".$table." SET nombre='".$_POST['nombre']."' ,";
   $query .= "apellido1='".$_POST['apellido1']."' ,";
   $query .= "apellido2='".$_POST['apellido2']."' ,";
   $query .= "fecha_nac='".$_POST['fecha_nac']."' ,";
   $query .= "repetidor='".$_POST['repetidor']."' ";
   $query .= "WHERE dni='".$_POST['dni']."'";

   mysql_query($query, $link) or die("Error en UPDATE: ".mysql_error($link));
   echo "<br/>Registro actualizado<br/>";
   echo "<a href='form43.php'>Volver al formulario</a>";
   exit();
}

?>

/* Este JavaScript nos devuelve al formulario. Llegaremos  */
/* aquí en caso de que se haya pulsado el botón "Cancelar" */
<script language="JavaScript"> 
window.self.location="form43.php"; 
</script> 
