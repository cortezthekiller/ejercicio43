Ejercicio 43:
Crea los formularios y scripts necesarios para poder elegir un alumno 
cualquiera mediante su DNI –en la tabla1– y modificar cualquiera de 
sus datos personales.


Archivos:
- form43.php
- script43.php

- form43.php:
El formulario presenta en primera instancia una
interfaz muy simple, con un desplegable para seleccionar un 
alumno (se realiza un acceso a base de datos para recuperar 
los nombres de todos los alumnos en la tabla y mostrarlos en 
el desplegable) y un botón que nos muestra los datos del alumno
seleccionado.

El 'action' correspondiente al submit anterior es el propio 
archivo 'form43.php', que detectará que tiene que mostrar los datos
de un alumno en concreto. La interfaz cambia ahora a una tabla que
muestra los campos correspondientes al registro seleccionado (se 
realiza una consulta a la base de datos). Salvo el campo DNI, todos 
los demás pueden editarse (elementos input de un formulario). Tenemos 
ahora la opción de pulsar dos botones: 'OK' para guardar los cambios
de los datos del alumno en la base de datos y 'Cancel' para volver a 
la interfaz inicial (formulario con desplegable de selección de alumnos)

- script43.php:
Este script corresponde al 'action' de la interfaz anterior (tabla/formulario
para la edición de los datos personales de un alumno en el archivo 
'form43.php'). Efectúa un UPDATE del registro que se haya seleccionado 
en el formulario anterior siempre y cuando el usuario haya pulsado el 
botón OK. En caso de que haya pulsado el botón 'Cancel', se ejecuta un
JavaScript que nos devuelve al formulario de inicio. 
