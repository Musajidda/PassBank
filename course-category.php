
<style>
  df-messenger {
    --df-messenger-bot-message: #e0e0e0;
    --df-messenger-button-titlebar-color: green;
    --df-messenger-chat-background-color: white;
    --df-messenger-font-color: black;
    --df-messenger-send-icon: #ffffff;
    bottom: 80px;
    right: 20px;
  }
</style>
<?php
session_start();

//check if user is not logged in
if(!isset($_SESSION["user"])){
    header("location: login.php");
}
 require "inc/process.php";
 require "inc/header.php";
 if (isset($_GET["search"]) && !empty($_GET["search"])) {
  // search logic will handle it later
} elseif (isset($_GET["course_category_id"]) && !empty($_GET["course_category_id"])) {
  $id = $_GET["course_category_id"];
} else {
  header("location: all-questions.php");   
  exit();
}
?>

<div class="container">
<?php require './pages/header-home.php'; ?>
 <div clas="container-fluid my-3">
    <div class="row justify-content-center">
      <div class="col-8">
        </div>

        <form method="GET" action="" class="mb-4">
    <input type="text" name="search" class="form-control" placeholder="Search course title or code..." required>
    <button type="submit" class="btn btn-success mt-2">Search</button>

    <!-- Dialogflow Messenger Chatbot -->
<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger
  intent="WELCOME"
  chat-title="AskBot"
  agent-id="asmaa"
  language-code="en">
</df-messenger>

</form>

        <div class="col-8">
            <div class="row">
              <?php
             

              $questions = [];

if (isset($_GET["search"]) && !empty($_GET["search"])) {
    $search = mysqli_real_escape_string($connection, $_GET["search"]);
    $sql = "SELECT * FROM questions WHERE course_title LIKE '%$search%' OR course_code LIKE '%$search%' ORDER BY id DESC";
    $query = mysqli_query($connection, $sql);
} elseif (isset($_GET["course_category_id"]) && !empty($_GET["course_category_id"])) {
    $id = $_GET["course_category_id"];
    $sql = "SELECT * FROM questions WHERE course_id = '$id' ORDER BY id DESC";
    $query = mysqli_query($connection, $sql);
} else {
    header("location: all-questions.php");
    exit();
}

              $query = mysqli_query($connection,$sql);
              if (mysqli_num_rows($query) === 0) {
                echo "<p>No questions found for your search.</p>";
            }
            
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

