$(document).ready(function(){



    $.ajax({
        type: "POST",
        url: './controller/empleado.php?flag=listar',
        dataType: "json",
        success: function(data) {

            console.log(data)
            $.each(data, function(index, key) {

               var boletin = key[4] == 1 ? "SI":"NO"

               $('#tablaEmpleados tbody').append(
                `<tr>
                <td>` + key[0] + `</td>
                <td>` + key[1] + `</td>
                <td>` + key[2] + `</td>
                <td>` + key[3] + `</td>
                <td>` + key[6] + `</td>
                <td>` + boletin + `</td>
                <td>` + key[7] + `</td>
                <td>` + key[8] + `</td>
                </tr>`);
           });

        }
    });

});


function modalGuardar(){

 $("#guardar").show()
 $("#actualizar").hide()

 $.ajax({
    type: "POST",
    url: './controller/util.php?flag=roles',
    dataType: "json",
    beforeSend: function() {
        $('#area_id option').remove();
    },
    success: function(data) {
        console.log(data)
        $('#area_id').append("<option value='' >Seleccionar una opción</option>");
        $.each(data[1], function(index, key) {
            $('#area_id').append("<option value=" + key.id + ">" + key.nombre + "</option>");
        });


        $.each(data[0], function(index, key) {
            $('#checkRol').append(`<input class="form-check-input" type="checkbox" id="roles" name="roles[]"
                value="`+key.id+`"
                required>`+key.nombre+`<br>`);
        });

    }
});


 $("#staticBackdrop").modal('show')

}

function guardar(value) {

    var check = comprobarChecks(event);
    var form = validarForm($("#nombre").val(),$("#email").val(),$("#sexo").val(),$("#area_id").val(),$("#descripcion").val(),$("#boletin").val())

    if (check == true && form == true ) {
        $.ajax({
            type: "POST",
            url: './controller/empleado.php?flag=guardar',
            data: $("#formEmpleado").serialize(),
            dataType: "json",
            beforeSend: function() {

            },
            success: function(data) {
                console.log(data.id)

                if (data.id == 1) {
                    swal("Exitoso", data.msm, "error")
                    .then((value) => {
                        location.reload()
                    });
                }else{
                    swal("Exitoso", "Registro guardado", "success")
                    .then((value) => {
                        location.reload()
                    });
                }
                

            }
        });
    }


    
}

function comprobarChecks(event){
    var checkbox = document.getElementsByName('roles[]');
    var contador = 0;
    for(var i=0; i< checkbox.length; i++) {
        if(checkbox[i].checked)
            contador++
    }

    //Con JQuery contador=$('[name="groupCheckbox[]"]:checked').length
    if(contador ==0){
        swal("OOOOPS!", "Debe selecionar minimo un rol", "info");
        event.preventDefault();
    }else{
        return true;
    }
}

function validarForm(nombre,email,sexo,area_id,descripcion,boletin){

    if( nombre == "" || email == "" || sexo == "" || area_id == "" || descripcion == "" || boletin == ""){
     swal("OOOOPS!", "Los campos con (*) son obligatorios", "info");  
 }else{
    return true;
}


}


function eliminar(value) {

    swal({
        title: "Esta seguro que desea eliminar el registro?",
        text: "Por favor seleccionar OK si desea eliminar el registro!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "POST",
                url: './controller/empleado.php?flag=eliminar',
                data: { value: value },
                success: function(data) {
                    swal("Exitoso", 'Registro eliminado', "success")
                    .then((value) => {
                        location.reload();
                    });
                }
            });
        } else {
            location.reload();
        }
    });
}

function editar(value){

    $("#guardar").hide()
    $("#actualizar").show()
    $("#staticBackdrop").modal('show')


    $.ajax({
        type: "POST",
        url: './controller/empleado.php?flag=ver',
        data: { value: value },
        dataType: "json",
        beforeSend: function() {
            $('#area_id option').remove();
             document.getElementById("checkRol").innerHTML="";
   
        },
        success: function(data) {
         $.each(data[1], function(index, key) {
            $('#area_id').append("<option value=" + key.id + ">" + key.nombre + "</option>");
        });


         $.each(data[0], function(index, key) {
            $('#checkRol').append(`<input class="form-check-input" type="checkbox" id="rol`+key.id+`" name="roles[]"
                value="`+key.id+`"
                required>`+key.nombre+`<br>`);

            $.each(data[3], function(index, row) {
                row.id == key.id ? document.querySelector('#rol'+row.id).checked = true : '';
            });

        });
         $("#id").val(value)
         $("#nombre").val(data[2][0].nombre)
         $("#email").val(data[2][0].email)
         $("#area_id").val(data[2][0].area_id)
         $("#descripcion").val(data[2][0].descripcion)

         document.querySelector('#flexRadioDefault1').checked = true;

         data[2][0].sexo == 'M' ? document.querySelector('#flexRadioDefault1').checked = true:document.querySelector('#flexRadioDefault2').checked = true;
         data[2][0].boletin == '1' ? document.querySelector('#boletin').checked = true : '' ;



     }
 });

}


function actualizar(){
 var check = comprobarChecks(event);
 var form = validarForm($("#nombre").val(),$("#email").val(),$("#sexo").val(),$("#area_id").val(),$("#descripcion").val(),$("#boletin").val())

 if (check == true && form == true ) {
    $.ajax({
        type: "POST",
        url: './controller/empleado.php?flag=actualizar',
        data: $("#formEmpleado").serialize(),
        beforeSend: function() {

        },
        success: function(data) {
            swal("Exitoso", "Registro actualizado", "success")
            .then((value) => {
                location.reload()
            });

        }
    });
}
}