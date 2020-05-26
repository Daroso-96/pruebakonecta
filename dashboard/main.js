$(document).ready(function(){
    tablaAsesores = $("#tablaAsesores").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
       }],
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
$("#btnNuevo").click(function(){
    $("#formAsesor").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Asesor");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    nombre = fila.find('td:eq(1)').text();
    cedula =  parseInt(fila.find('td:eq(2)').text());
    telefono = parseInt(fila.find('td:eq(3)').text());
    genero = fila.find('td:eq(4)').text();
    cliente = fila.find('td:eq(5)').text();
    sede= fila.find('td:eq(6)').text();
    
    $("#nombre").val(nombre);
    $("#cedula").val(cedula);
    $("#telefono").val(telefono);
    $("#genero").val(genero);
    $("#cliente").val(cliente);
    $("#sede").val(sede);

    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Persona");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaPersonas.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formAsesor").submit(function(e){
    e.preventDefault();    
    nombre = $.trim($("#nombre").val());
    cedula = $.trim($("#cedula").val());
    telefono = $.trim($("#telefono").val());   
    genero = $.trim($("#genero").val());   
    cliente = $.trim($("#cliente").val());   
    sede = $.trim($("#sede").val());    

    $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json",
        data: {nombre:nombre, cedula:cedula, telefono:telefono,genero:genero,cliente:cliente,sede:sede, id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;            
            nombre = data[0].nombre;
            cedula = data[0].cedula;
            telefono = data[0].telefono;
            genero = data[0].genero;
            cliente = data[0].cliente;
            sede = data[0].sede;
            if(opcion == 1){tablaAsesores.row.add([id,nombre,cedula,telefono,genero,cliente, sede]).draw();}
            else{tablaAsesores.row(fila).data([id,nombre,cedula,telefono,genero,cliente,sede]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
    
});    
    
});