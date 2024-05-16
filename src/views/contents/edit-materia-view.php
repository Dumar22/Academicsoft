<!-- Editar usuario -->



<div class="container c-welcome d-flex justify-content-center">
    <div class="container">
        <div class="text-center">
            <?php

            $id = $instLogin->cleanQuery($url[1]);

            if ($id == $_SESSION['id']) {
            ?>
                <h3 class="mt-5 text-uppercase">Editar Materia</h3>
            <?php } else { ?>
            <?php } ?>
            <h3 class="mt-5 text-uppercase">Editar datos Materia</h3>


        </div>

        <?php

        include "./views/inc/btn_back.php";

        $datos = $instLogin->selectedData("Unico", "materias", "materia_id", $id);
       
        if ($datos->rowCount() == 1) {
            $datos = $datos->fetch();
        ?>
            <form class="FormularioAjax" action="<?php echo SERVER_URL ?>src/ajax/userMateriasAjax.php" method="post" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="modulo_materia" value="actualizar">
                <input type="hidden" name="materia_id" value="<?php echo $datos['materia_id']; ?>">
                <div class="row">
                    <div class=" d-flex justify-content-center flex-wrap ">
                    <div class="form-group col-sm-10 col-md-6 col-lg-4 m-4">
                            <label for="nombre">Materia:</label>
                            <input type="text" class="form-control" name="materia_nombre" value="<?php echo $datos['materia_nombre']; ?>" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required>
                        </div>
                        <div class="form-group col-sm-10 col-md-6 col-lg-4 m-4">
                            <label for="materia_intensidad_horaria">Intensidad horaria:</label>
                            <input type="text" class="form-control" name="materia_intensidad_horaria" value="<?php echo $datos['materia_intensidad_horaria']; ?>" maxlength="40">
                        </div>
                        
                        
                    </div>
                    
                </div>

                <div class="d-flex justify-content-center flex-wrap mb-4">
                    <div class="col-sm-10 col-md-6 col-lg-4 m-4">
                        <button type="reset" class="btn btn-info btn-block mt-4 mr-2">Limpiar</button>
                    </div>
                    <div class="col-sm-10 col-md-6 col-lg-4 m-4">
                        <button type="submit" class="btn btn-primary btn-block mt-4">Guardar</button>
                    </div>
                </div>
            </form>
        <?php
        } else {
            include "./views/inc/error_alert.php";
        }
        ?>
    </div>
</div>


<!-- fin Editar materia -->