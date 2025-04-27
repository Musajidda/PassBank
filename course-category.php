<?php
session_start();

//check if user is not logged in
if(!isset($_SESSION["user"])){
    header("location: login.php");
}
 require "inc/process.php";
 require "inc/header.php";

 if(isset($_GET["course_category_id"]) && !empty($_GET["course_category_id"])){
   $id = $_GET["course_category_id"];
 }else{
   header("location: all-questions.php");   
 }
 
 ?>

<div class="container">
<?php require './pages/header-home.php'; ?>
 <div class="container-fluid my-3">
    <div class="row justify-content-center">
      <div class="col-8">
        </div>
        <div class="col-8">
            <div class="row">
              <?php
              $sql = "SELECT * FROM questions WHERE course_id ='$id' ORDER BY id DESC";
              $query = mysqli_query($connection,$sql);
               while($result = mysqli_fetch_assoc($query)) { 
                //Looping through the col for multiples product
                ?>
              <div class="col-4 mt-2">
              <div class="card" >
           <div class="card-body">
         <h5 class="card-title"><?php echo $result["course_title"]; ?></h5>
         <h5 class="card-title"><?php echo $result["course_code"]; ?></h5>
         <h5 class="card-title"><?php echo $result["session"]; ?></h5>
        <a href="view-question.php?question_id=<?php echo $result["id"]; ?>" class="btn  btn-sm text-light" style="background-color:darkgreen;">
        <i class="fas fa-eye"></i> View Question</a>
      </div>
     </div>
</div>
            <?php
            }
          ?>
     </div>   
  </div>    

 </div>
     </div>
     <?php require './pages/footer-home.php'; ?>
  </div>

 <?php
 require "inc/footer.php"; 
 ?>

