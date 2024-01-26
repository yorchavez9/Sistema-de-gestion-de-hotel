<div id="back"></div>

<body class="hold-transition login-page">

  <div class="login-box">

    <div class="login-logo">

      <a href="<?php echo $ruta?>"><strong>HOTEL PARACAS</strong></a>
    
    </div>

    <div class="card">

      <div class="card-body login-card-body">

        <p class="login-box-msg"><strong>ACCESO AL SISTEMA</strong></p>

        <form method="post">

          <div class="input-group mb-3">

            <input type="text" class="form-control" placeholder="Ingresar Usuario" name="ingresoUsuario">

            <div class="input-group-append">

              <div class="input-group-text">

                <span class="fas fa-envelope"></span>

              </div>

            </div>

          </div>

          <div class="input-group mb-3">

            <input type="password" class="form-control" placeholder="Ingresar Contraseña" name="ingresoPassword">

            <div class="input-group-append">

              <div class="input-group-text">

                <span class="fas fa-lock"></span>

              </div>

            </div>

          </div>        

          <button type="submit" class="btn btn-primary btn-block btn-flat" style="font-size: 16px">INGRESAR</button>

           <?php

          $ingreso = new ControladorAdministradores();
          $ingreso -> ctrIngresoAdministradores(); 


          ?>     
   
        </form>

      </div>
 
    </div>

  </div>

</body>