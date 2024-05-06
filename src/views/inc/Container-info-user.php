 <!-- Container info Bienvenida user -->
 <div class="container-info-user d-flex justify-content-between">
    <h3> <strong> Bienvenido </strong>&nbsp; <?php echo  strtoupper($_SESSION['nombre']." ".$_SESSION['apellido']) ?> </h3>
    <h3> <strong> Rol: </strong>&nbsp; <?php echo strtoupper($_SESSION['rol']); ?> </h3>
    </div>