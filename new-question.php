<?php  
session_start();

//check if user is not logged in
if(!isset($_SESSION["user"])){
    header("location: login.php");
}//check if logged in as user
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
        <div> 
        <li class="list-group-item" style="color:darkgreen;">
            <a href="course.php" class="btn">
                <i class="fas fa-grip-vertical"style="color:darkgreen;" ></i> COURSES</a>
        </li>    
        <li  class="list-group-item">
            <a href="questions.php" class="btn">
                <i class="fas fa-boxes" style="color:darkgreen;"></i> QUESTIONS</a>
        </li  class="list-group-item">
        <li  class="list-group-item">
             <a href="new-question.php" class="btn text-danger">
                 <i class="fas fa-plus" style="color:darkgreen;"></i> ADD QUESTION</a>
        </li>
        </div>
    </ul>
</div>


         <div class="col-9">
             <div class="container">
                 <h6>Add New Question</h6>
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
                 
                 <form action="" method="post" enctype="multipart/form-data">
                 <div class="form-group">
                <label for="">Select File Type: JPG,PDF,Docs All should not exceed [1.5MB]</label>
                <select name="file_type" class="form-control" required>
                    <option value="image">Image</option>
                    <option value="pdf">PDF</option>
                    <option value="docs">Docs</option>
                </select>
            </div>
                     <div class="form-group">
                         <label for="questionPaper">Select Question Paper</label>
                         <input type="file" name="file" class="form-control" required>
                     </div>
                     <div class="form-group">
                         <label for="">Course Title</label>
                         <input type="text" name="course_title" placeholder="Enter course title"
                          class="form-control" id="" required>
                     </div> 
                     <div class="row">
                         <div class="col-6">
                             <div class="form-group">
                                 <label for="">Course Code</label>
                                  <input type="text" name="course_code" placeholder="Enter course code"
                                 class="form-control" id="" required>
                             </div>
                         </div>
                        <div class="col-6">
                                <div class="form-group">
                                    <label for="">Course</label>
                                    <select name="course_id" class="form-control" id="">
                                       <?php
                                         $sql = "SELECT * FROM courses ORDER BY id DESC";
                                         $query = mysqli_query($connection,$sql);
                                         while($result = mysqli_fetch_assoc($query)){
                                             ?>
                                             <option value="<?php echo $result["id"] ?>">
                                             <?php echo $result["name"] ?>
                                            </option>
                                             <?php
                                         }
                                       ?>  
                                    </select>
                                </div>
                            </div> 
                     </div>
                     <div class="form-group">
                         <label for="">Session</label>
                          <input type="text" name="session" placeholder="Enter session year"
                                 class="form-control" id="" required>
                           </div>   
                           <div class="form-group">
                         <button type="submit" name="new_question" 
                          class="btn btn-sm text-light my-2" style="background-color:darkgreen;">
                          Add <i class="fas fa-plus"></i></button>
                     </div>
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