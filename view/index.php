<?php include 'template/header.php' ?>

<div class="container bg-light mt-5">

    <div class="col-md-7">
        <button type="button" class="btn btn-primary btn-sm" onclick="modalGuardar()">
            Registrar empleado
        </button>
    </div>

    <div class="row mt-5">

        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">
                    Lista de empleados
                </div>
                <div class="p-4 table-responsive">
                    <table class="table table-striped" id="tablaEmpleados">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Email</th>
                                <th scope="col">Sexo</th>
                                <th scope="col">Area</th>
                                <th scope="col">Boletin</th>
                                <th scope="col">Modificar</th>
                                <th scope="col">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>


<!-- Modal ingresar emleado -->

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Ingresar empleado</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">

            <div class="alert alert-success" role="alert">
                Los campos con (*) son obligatorios
            </div>
            <form id="formEmpleado">
                  <input type="hidden" class="form-control form-control-sm" id="id" name="id"
                        placeholder="ID">

                <div class="mb-3 row">
                    <label for="nombre" class="col-sm-4 col-form-label">Nombre completo(*)</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="nombre" name="nombre"
                        placeholder="Nombre completo">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-sm-4 col-form-label">Email(*)</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="email" name="email"
                        placeholder="Email">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Sexo(*)</label>
                    <div class="col-sm-8">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="M" name="sexo" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Masculino
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="F" name="sexo" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Femenino
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nombre" class="col-sm-4 col-form-label">Area(*)</label>
                    <div class="col-sm-8">
                        <select class="form-control form-control-sm" id="area_id" name="area_id" value="">
                            <option value="">Seleccionar area </option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-sm-4 col-form-label">Descripción(*)</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="descripcion" name="descripcion" value=""
                        placeholder=" Descripción de la experiencia del empleado " required></textarea>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-8" >

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="boletin" name="boletin"
                                value="1"
                                required>Deseo recibir información del boletin informativo
                        </div>

                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-sm-4 col-form-label">Roles(*)</label>
                    <div class="col-sm-8" id="checkRol">

                        <div class="form-check"></div>

                    </div>
                </div>
            </form>


        </div>


        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="guardar" onclick="guardar()">Guardar</button>
            <button type="button" class="btn btn-primary" id="actualizar" onclick="actualizar()">Actualizar</button>
        </div>
    </div>
</div>
</div>

<!-- Fin ingresar empleado -->


<?php include 'template/footer.php' ?>