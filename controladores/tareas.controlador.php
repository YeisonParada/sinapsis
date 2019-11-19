<?php
		
class ControladorTareas{

	/*=============================================
	REGISTRO DE TAREA
	=============================================*/

	static public function ctrCrearTarea(){

		if(isset($_POST["fecha"])){

				$tabla = "tareas";

				$datos = array("fecha" => $_POST["fecha"],
					           "descripcion" => $_POST["descripcion"],
							   "encargado" => $_POST["encargado"],
							   "estado" => $_POST["estado"]);
				$respuesta = ModeloTareas::mdlIngresarTarea($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡La tarea ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "index.php";

						}

					});
				

					</script>';


				}else{
					echo '<script>

					swal({

						type: "error",
						title: "¡Error! ->'.$respuesta.'",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "index.php";

						}

					});
				

				</script>';
				}

		}


	}

	/*=============================================
	MOSTRAR TAREAS
	=============================================*/

	static public function ctrMostrarTareas($fechaInicial,$fechaFinal){

		$tabla = "tareas";

		$respuesta = ModeloTareas::mdlMostrarTareas($tabla,$fechaInicial,$fechaFinal);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR ENCARGADOS
	=============================================*/

	static public function ctrMostrarEncargados($item, $valor){

		$tabla = "encargados";

		$respuesta = ModeloTareas::mdlConsultaDinamica($tabla, $item, $valor);
		return $respuesta;
	}

		/*=============================================
	MOSTRAR ESTADOS
	=============================================*/

	static public function ctrMostrarEstados($item, $valor){

		$tabla = "estados";

		$respuesta = ModeloTareas::mdlConsultaDinamica($tabla, $item, $valor);

		return $respuesta;
	}

}
	


