<nav class="navbar navbar-expand-lg nav-container">
    <!-- Container wrapper -->
    <div class="container-fluid">
      
      <!-- Toggle button -->
      <button
        data-mdb-collapse-init
        class="navbar-toggler"
        type="button"
        data-mdb-target="#navbarLeftAlignExample"
        aria-controls="navbarLeftAlignExample"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars"></i>
      </button>
      
  
      <!-- Collapsible wrapper -->
      <div class="collapse navbar-collapse" id="navbarLeftAlignExample">
        <!-- Left links -->
        <ul class="navbar-nav d-flex align-items-center">
          
          <!-- Avatar -->
        <li class="nav-item nav-img dropdown">
          <a data-mdb-dropdown-init class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
            id="navbarDropdownMenuLink" role="button" aria-expanded="false">
            <?php 
            
            if(is_file("./views/fotos/".$_SESSION['foto'])){
              echo '<img class="rounded-circle" height="50" alt="Avatar" src="'.SERVER_URL.'src/views/fotos/'.$_SESSION['foto'].'">';
            }else{
              echo '<img class="rounded-circle" height="50" alt="Avatar" src="https://mdbootstrap.com/img/new/avatars/2.jpg">';
            }
            ?>
            <!--  -->
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="<?php echo SERVER_URL."src/user-profile/".$_SESSION['id']."/"; ?>">My profile</a></li>           
            <li><a class="dropdown-item" href="<?php echo SERVER_URL; ?>src/logOut">Logout</a></li>
          </ul>
        <li class="nav-item">
        <a class="nav-link" href="<?php echo SERVER_URL; ?>src/dashboard">Inicio</a>
    </li>
<?php if ($_SESSION['rol'] === 'administrador') { ?>
    <!-- Mostrar solo para administradores -->
    <li class="nav-item">
    <a class="nav-link" href="<?php echo SERVER_URL; ?>src/list-guardians/">Acudientes</a>
</li>
    <li class="nav-item">
    <a class="nav-link" href="<?php echo SERVER_URL; ?>src/list-students/">Estudiantes</a>
</li>
<li class="nav-item">
        <a class="nav-link" href="<?php echo SERVER_URL; ?>src/list-grades/">Grado</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo SERVER_URL; ?>src/list-materias/">Materia</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo SERVER_URL; ?>src/list-notes/">Notas</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo SERVER_URL; ?>src/list-teachers/">Profesores</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo SERVER_URL; ?>src/report/">Reportes</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo SERVER_URL; ?>src/list-user-admin/">Usuarios</a>
    </li>
   
<?php } elseif ($_SESSION['rol'] === 'profesor') { ?>
    <!-- Mostrar solo para profesores -->
    <li class="nav-item">
    <a class="nav-link" href="<?php echo SERVER_URL; ?>src/list-guardians/">Acudientes</a>
</li>
    <li class="nav-item">
    <a class="nav-link" href="<?php echo SERVER_URL; ?>src/list-students/">Estudiantes</a>
</li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo SERVER_URL; ?>src/list-grades/">Grado</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo SERVER_URL; ?>src/list-materias/">Materia</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo SERVER_URL; ?>src/list-notes/">Notas</a>
    </li>
    
    
<?php } elseif ($_SESSION['rol'] === 'estudiante' || $_SESSION['rol'] === 'acudiente') { ?>
    <!-- Mostrar solo para estudiantes -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo SERVER_URL; ?>src/list-notes-user/">Notas</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo SERVER_URL; ?>src/report/">Reportes</a>
    </li>
<?php } ?>


</ul>
        <!-- Left links -->
      </div>
      <!-- Collapsible wrapper -->
      <div class="d-flex exit align-items-center">
        <!-- Salir -->
        <div class="dropdown ">
          <a class="nav-link" href="<?php echo SERVER_URL; ?>src/logOut"  id="btn_exit">SALIR
            <i class="fas fa-power-off"></i>
          </a>
        </div>

      </div>
    </div>
    <!-- Container wrapper -->
  </nav>