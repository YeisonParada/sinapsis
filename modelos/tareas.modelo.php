<?php

require_once "conexion.php";

class ModeloTareas{

	/*=============================================
	CONSULTA DINAMICA
	=============================================*/

	static public function mdlConsultaDinamica($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR TAREAS POR RANGO DE FECHA
	=============================================*/

	static public function mdlMostrarTareas($tabla,$fechaInicial,$fechaFinal){

		if($fechaInicial == null){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla 
			ORDER BY id DESC");

            $stmt -> execute();

            return $stmt -> fetchAll(); 

        }else{

                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla 
				WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' ORDER BY id DESC");

        }
        
            $stmt -> execute();

            return $stmt -> fetchAll();   

	}

	/*=============================================
	REGISTRO DE TAREAS
	=============================================*/

	static public function mdlIngresarTarea($tabla, $datos){

		try{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(fecha, descripcion, encargado, estado) VALUES (:fecha, :descripcion, :encargado, :estado)");

		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":encargado", $datos["encargado"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);

		$stmt->execute();

			return "ok";	

		}catch(PDOException $e){

    		return $e->getMessage();

		}catch(Exception $e){

		   echo 'Exception -> ';
    		var_dump($e->getMessage());

		}  



		$stmt->close();
		
		$stmt = null;

	}

}