<?php require_once "vistas/head.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Contenido asesores</h1>
    
    
    
 <?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id, nombre, cedula, telefono, genero,cliente, sede FROM asesor";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaAsesores" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Cedula</th>                                
                                <th>Telefono</th>  
                                <th>Genero</th>
                                <th>Cliente</th>
                                <th>Sede</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['cedula'] ?></td>
                                <td><?php echo $dat['telefono'] ?></td>   
                                <td><?php echo $dat['genero'] ?></td> 
                                <td><?php echo $dat['cliente'] ?></td>
                                <td><?php echo $dat['sede'] ?></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
      
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo asesor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formAsesor">    
            <div class="modal-body">
                <div class="form-group">
                <label for="nombre" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre">
                </div>
                <div class="form-group">
                <label for="cedula" class="col-form-label">Cedula:</label>
                <input type="number" class="form-control" id="cedula">
                </div>                
                <div class="form-group">
                <label for="telefono" class="col-form-label">telefono:</label>
                <input type="number" class="form-control" id="telefono">
                </div>       

                 <div class="form-group">
                <label for="genero" class="col-form-label">Genero:</label>
                <input type="text" class="form-control" id="genero">
                </div>   

                 <div class="form-group">
                <label for="cliente" class="col-form-label">Cliente:</label>
                <input type="text" class="form-control" id="cliente">
                </div>        

                <div class="form-group">
                <label for="sede" class="col-form-label">Sede:</label>
                <input type="text" class="form-control" id="sede">
                </div>   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
      
    
    
</div>
<!--FIN del cont principal-->
<?php require_once "vistas/footer.php"?>