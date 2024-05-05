<div class="container c-login d-flex justify-content-center">
    <div class="row">
        
        <div class="login-content rounded-3">

            <div class="login-title text-center mb-4">
                <img src="<?php echo SERVER_URL; ?>src/views/assets/Logo.svg" alt="Academisoft-logo">
                <h2>INICIAR SESION</h2>
            </div>

			       <form class="" action="" method="POST" autocomplete="off">		

                 <div class=" login-label-input form-floating mb-4">
					         <input type="text" class="form-control" id="floatingUser" name="login_usuario" pattern="[a-zA-Z0-9]{1,35}" maxlength="35" required="" placeholder="">					
				          	<label for="floatingUser"><i class="fas fa-user-secret"></i>&nbsp; Usuario</label>
				         </div>
				          <div class=" login-label-input form-floating mb-4">
				     	     <input type="password" class="form-control" id="floatingPassword" name="login_clave" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required="" placeholder="">
				    	     <label for="floatingPassword"><i class="fas fa-lock"></i>&nbsp; Contraseña</label>
				          </div>
				          <button type="submit" class="btn btn-secondary text-center">LOG IN</button>
			       </form>             
		     </div>		
        
      
    </div>
  </div>


  <?php
	if(isset($_POST['login_usuario']) && isset($_POST['login_clave'])){
		$instLogin->iniciarSesionControlador();
	}
?>