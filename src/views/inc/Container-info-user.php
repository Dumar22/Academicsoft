 <!-- Container info Bienvenida user -->
 <div class="container-info-user d-flex justify-content-between">
    <h5> <strong> Bienvenido </strong>&nbsp; <?php echo  strtoupper($_SESSION['nombre']." ".$_SESSION['apellido']) ?> </h5>
    <h5> <strong> Rol: </strong>&nbsp; <?php echo strtoupper($_SESSION['rol']); ?> </h5>
    </div>