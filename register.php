<?php  
session_start();
//header links
 require "inc/header.php"; ?>

 <div class="container">

 <?php
 //header content
 require './pages/header-home.php';
 include 'inc/process.php'; ?>

<div class="d-flex aligns-items-center justify-content-center py-3">
    <form action="" method="post">

      <div class="form-group"> 
          <h4 class="text-center">REGISTER</h4>
          <?php 
              if(isset($error)) {
                  ?>
                  <div class="alert alert-danger">
                      <strong><?php echo $error ?></strong>
                  </div>
                  <?php
              }elseif (isset($success)) {
                  ?>
                <div class="alert alert-success">
                <strong><?php echo $success ?></strong>
               </div>
               <?php
              }
          ?>
      </div>

     <div class="input-group flex-nowrap my-3">
      <span class="input-group-text " style="background-color:darkgreen;"><i class="fas fa-id-badge"></i></span>
      <input type="text" name="name" class="form-control" placeholder="Name" required>
     </div>
     <div class="input-group flex-nowrap my-3">
       <span class="input-group-text " style="background-color:darkgreen;"><i class="fas fa-envelope"></i></span>
       <input type="text" name="email" class="form-control" placeholder="Email" required>
     </div>
     <div class="input-group flex-nowrap">
      <span class="input-group-text " style="background-color:darkgreen;"> <i class="fas fa-lock"></i></span>
      <input type="password" name="password" class="form-control" placeholder="Password" required>
     </div>
     <button type="submit" name="register" class="btn btn-sm my-3 form-control text-light" style="background-color:darkgreen;"><i class="fas fa-sign-in-alt"></i> SIGNUP</button>
     <br>
     <p><i>If already registered <a href="login.php">Signin</a></i></p>

    </form>
</div>    


<?php  
//footer content
require './pages/footer-home.php'; ?>

 </div>


 <?php
 //footer script
  require "inc/footer.php";  ?>