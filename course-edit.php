<?php  
session_start();

//check if user is not logged in
if(!isset($_SESSION["user"])){
    header("location: login.php");
}

//check if logged in as user
if($_SESSION["user"]["role"] == "user"){
    header("location: all-questions.php");
}

//header links
 require "inc/header.php"; ?>

 <div class="container">

 <?php
 //header content
 require './pages/header-home.php';
 include 'inc/process.php'; 
 //if user click edit
if(isset($_GET["edit_id"]) && !empty($_GET["edit_id"])){
    $edit_id = $_GET["edit_id"];
    //sql
    $sql = "SELECT * FROM courses WHERE id = '$edit_id'";
    $query = mysqli_query($connection,$sql);
    $result = mysqli_fetch_assoc($query);
}else{
    header("location: course.php");

}
 ?>

 <div class="container p-3">
     <div class="row">
         <div class="col-12">
             <div class="row">
                 <div class="col-6"> 
                     <h4>DASHBOARD</h4>  
                 </div>
             </div>
         </div>

         <div class="col-3">
     <ul class="list-group">
         <li class="list-group-item" style="color:darkgreen;">
             <a href="course.php" class="btn text-danger">
                 <i class="fas fa-grip-vertical" style="color:darkgreen;"></i> COURSES</a>
         </li>    
         <li class="list-group-item" style="color:darkgreen;">
            <a href="questions.php" class="btn">
                <i class="fas fa-boxes"  style="color:darkgreen;"></i> QUESTIONS</a>
         </li>
         <li class="list-group-item" style="color:darkgreen;">
                <a href="new-question.php" class="btn">
                    <i class="fas fa-plus"  style="color:darkgreen;"></i> ADD QUESTION</a>
         </li>
     </ul>
 </div>

         <div class="col-9">
             <div class="container">
                 <h6>Edit Course</h6>
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
                 <form action="" method="post">
                     <div class="form-group">
                         <label for="">Title</label>
                         <input type="text" name="name" value="<?php echo $result["name"];?> "
                         placeholder="Enter new course" class="form-control" id="">
                     </div>
                     <div class="form-group">
                         <button type="submit" style="background-color: darkgreen" name="edit_course" class="btn btn-sm btn-primary my-2">
                             Update</button>
                     </div>
                 </form>
             </div> 
         </div>
     </div>
 </div>

<?php  
//footer content
require './pages/footer-home.php'; ?>

 </div>


 <?php
 //footer script
  require "inc/footer.php";  ?>