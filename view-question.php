<?php

session_start();

//check if user is not logged in
if (!isset($_SESSION["user"])) {
    header("location: login.php");
}


require "inc/process.php";
require "inc/header.php";
if (isset($_GET["question_id"]) && !empty($_GET["question_id"])) {
    $id = $_GET["question_id"];
    //sql & query
    $sql = "SELECT * FROM questions WHERE id ='$id' ";
    $query = mysqli_query($connection, $sql);
    //result
    $result = mysqli_fetch_assoc($query);
} else {
    header("location: index.php");
}
//session to store url
$_SESSION["url"] = $_GET["question_id"];
?>
<div class="container">
    <?php require './pages/header-home.php'; ?>
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-8">
                <?php
                if (isset($error)) {
                ?>
                    <div class="alert alert-danger">
                        <strong><?php echo $error ?></strong>
                    </div>
                <?php
                } elseif (isset($success)) {
                ?>
                    <div class="alert alert-success">
                        <strong><?php echo $success ?></strong>
                    </div>
                <?php
                }
                ?>
<?php
$cid = $result["course_id"];
//sql & query to get course_id name
$sql2 = "SELECT * FROM courses WHERE id='$cid' ";
$query2 = mysqli_query($connection, $sql2);
$result2 = mysqli_fetch_assoc($query2);
?>

<div class="row">
    <div class="col-10">
        <?php
        $fileType = pathinfo($result["file_path"], PATHINFO_EXTENSION);

        if (in_array(strtolower($fileType), ["jpg", "jpeg", "png", "gif"])) {
            // Display image
            echo '<img style="width:500px; height:500px;" src="' . $result["file_path"] . '" alt="">';
        } else {
            // Display download button for PDF or Docs with the file name
            echo '<a href="' . $result["file_path"] . '" download="' . basename($result["file_path"]) . '">Download File</a>';
        }
        ?>
    </div>
    <div class="col-2">
        <h6>COURSE: <?php echo $result2["name"] ?></h6>
        <h6>TITLE: <?php echo $result["course_title"] ?></h6>
        <h6>CODE: <?php echo $result["course_code"] ?></h6>
        <h6>SESSION: <?php echo $result["session"] ?></h6>
    </div>
</div>
</div>



        </div>
    </div>
    <?php require './pages/footer-home.php'; ?>
</div>


<?php
require "inc/footer.php";
?>