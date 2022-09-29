<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="<?php echo base_url("public/css/login/login.css")?>" rel="stylesheet" type="text/css"/>
</head>

<body>
    <div class="container">
      <div class="screen">
        <div class="screen__content">
          <form class="login" method="post" action="?mod=home&controller=login&action=login">
            <div class="login__field">
              <i class="login__icon fas fa-user"></i>
              <input type="email" name="email" class="login__input" placeholder="Email" >
            </div>
            <div class="login__field">
              <i class="login__icon fas fa-lock"></i>
              <input type="password" name="password" class="login__input" placeholder="Password">
            </div>
            <?php echo checkVarEmpty($anounceLoginFail); ?>
            <button class="button login__submit">
              <span class="button__text">Log In Now</span>
              <i class="button__icon fas fa-chevron-right"></i>
            </button>
          </form>
          <div class="social-login">
            <h3>Admin area</h3>
            <div class="social-icons">
              <a href="#" class="social-login__icon fab fa-instagram"></a>
              <a href="#" class="social-login__icon fab fa-facebook"></a>
              <a href="#" class="social-login__icon fab fa-twitter"></a>
            </div>
          </div>
        </div>
        <div class="screen__background">
          <span class="screen__background__shape screen__background__shape4"></span>
          <span class="screen__background__shape screen__background__shape3"></span>
          <span class="screen__background__shape screen__background__shape2"></span>
          <span class="screen__background__shape screen__background__shape1"></span>
        </div>
      </div>
    </div>
</body>

</html>