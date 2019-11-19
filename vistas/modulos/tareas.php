
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar tareas
    
    </h1>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarTarea">
          
          Agregar tarea

        </button>
        <button type="button" class="btn btn-default pull-right" id="daterange-btn">
           
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>

            <i class="fa fa-caret-down"></i>

         </button>
      </div>
      
         
      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>         
           <th style="width:10px">#</th>
           <th>Fecha</th>
           <th>Descripción</th>
           <th>Encargado</th>
           <th>Estado</th>
         </tr> 

        </thead>

        <tbody>

        <?php
      if(isset($_GET["fechaInicial"])){

        $fechaInicial = $_GET["fechaInicial"];
        $fechaFinal = $_GET["fechaFinal"];

      }else{

        $fechaInicial = null;
        $fechaFinal = null;

      }


       $tareas = ControladorTareas::ctrMostrarTareas($fechaInicial,$fechaFinal);

       foreach ($tareas as $key => $value){
         
            echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["fecha"].'</td>
                  <td>'.$value["descripcion"].'</td>';

            $encargado = ControladorTareas::ctrMostrarEncargados("id",$value["encargado"]);
            echo'<td>'.$encargado["nombre"].'</td>';

            $estado = ControladorTareas::ctrMostrarEstados("id",$value["estado"]);
            echo'<td>'.$estado["nombre"].'</td>
                </tr>';
        }


        ?> 

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR LOCAL
======================================-->

<div id="modalAgregarTarea" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" >

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar tarea</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

        <!-- ENTRADA PARA LA FECHA -->

          <div class="form-group">

              <div class="input-group">
              
                <span class="input-group-addon"><i class="fas fa-calendar-alt"></i></span> 

                <input type="date" class="form-control input-lg" name="fecha" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fas fa-eye"></i></span> 

                <textarea class="form-control" name="descripcion" rows="2" placeholder="Escribir una descripción" required></textarea>

              </div>

            </div>

            <!-- ENTRADA PARA EL ENCARGADO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fas fa-user"></i></span> 

                 <select class="form-control input-lg" name="encargado" >
                  
                  <option value="">Selecionar encargado</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $encargados = ControladorTareas::ctrMostrarEncargados($item,$valor);

                  foreach ($encargados as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL ESTADO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fas fa-file-signature"></i></span> 

                <select class="form-control input-lg " name="estado"   id="estado" required >
                    
                    <option value="">Selecionar estado</option>

                    <?php

                      $item = null;
                      $valor = null;

                      $estados = ControladorTareas::ctrMostrarEstados($item,$valor);

                      foreach ($estados as $key => $value) {
                        
                        echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                      }

                    ?>

                  </select>

              </div>

            </div>

            

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar tarea</button>

        </div>

        <?php

          $crearTarea = new ControladorTareas();
          $crearTarea -> ctrCrearTarea();

        ?>

      </form>

    </div>

  </div>

</div>


