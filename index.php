<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/tareas.controlador.php";

require_once "modelos/tareas.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();