<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="view/login/login_user.css">

<div class="section">
  <h4 id="logo">Morning</h4>
  <div class="box">
    <div class="form">
      <div id="circulo"><img src="assets/img/log_page/circulo4.png" alt="" id="imagemC"></div>
      <form method="post">
        <div class="col-auto">
          <label class="sr-only" for="inlineFormInputGroup">Email</label>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><img src="assets/img/log_page/user.png" alt=""></div>
            </div>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
          </div>
        </div>
        <div class="col-auto">
          <label class="sr-only" for="inlineFormInputGroup">Password</label>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><img src="assets/img/log_page/lock.png" alt=""></div>
            </div>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
        </div>
        <div class="col-auto">
          <button type="submit" class="btn btn-danger" id="confirmBtn" name="confirmBtn">Login</button>
        </div>
        <div class="col-auto">
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<?php

  use App\Controllers\UserController;

  if(isset($_POST['confirmBtn'])){
    $s = UserController::login();
    if($s != false){

      $_SESSION['logged'] = true;
      $_SESSION['id'] = $s->getId();
      $_SESSION['name'] = $s->getName();
      $_SESSION['email'] = $s->getEmail();

      //var_dump($_SESSION);

      echo '<script> window.location.href = "home";</script>';
    }else{
      echo '<div class="alert h6 mt-2" role="alert" style="color: #856404;background-color: #fff3cd;border-color: #ffeeba;">
              Email or password is wrong.
            </div>';
    }
}

?>