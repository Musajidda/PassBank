<?php
session_start();

//check if logged in as user
// if($_SESSION["user"]["role"] == "user"){
//     header("location: all-questions.php");
// }

require "inc/process.php";
require "inc/header.php";
?>

<div class="container">
    <?php require './pages/header-home.php'; ?>
    <div class="container-fluid my-3">
        <img class="d-block mx-auto mb-4" src="./img/p1.PNG" style="border-radius: 15px" alt="" width="950" height="450">
        <div class="row">
            <div class="col-6">
                <div class="p-3 my-3 text-center">
                    <h3 class="display-5 fw-bold" style="color: darkgreen">PassBank</h3>
                    <div class="col-lg-6 mx-auto">
                        <p class="lead mb-4">A Platform for sharing pass questions, Quickly get access to all Pass Questions in different courses and sessions.</p>
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="p-3 my-3 text-center">
                    <h3 class="display-5 fw-bold" style="color: darkgreen">Why Us</h3>
                    <div class="col-lg-6 mx-auto">
                        <p class="lead mb-4">offers a comprehensive question bank, verified content, and a supportive community, making it the ideal platform. </p>
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">

                        </div>
                    </div>
                </div>
            </div>
            <img class="d-block mx-auto mb-4" src="./img/p2.PNG" style="border-radius:15px" alt="" width="950" height="450">

        </div>
    </div>
    <div class="container-fluid my-3 " id="#question">
        <div class="row">
            <div class="col-8 ">
                <div class="row">
                    <?php
                    //displaying the products from database
                    $sql = "SELECT * FROM questions ORDER BY id DESC";
                    $query = mysqli_query($connection, $sql);
                    while ($result = mysqli_fetch_assoc($query)) {
                        //Looping through the col for multiples product
                    ?>
                        <div class="col-4 mt-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"> <?php echo $result["course_title"]; ?></h5>
                                    <h5 class="card-title">Course Code: <?php echo $result["course_code"]; ?></h5>
                                    <h5 class="card-title">Session: <?php echo $result["session"]; ?></h5>
                                    <a href="view-question.php?question_id=<?php echo $result["id"]; ?>" class="btn btn-sm text-light" style="background-color:darkgreen;"><i class="fas fa-eye"></i> View Question</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col">
                <div class="border p-3 my-3">
                    <h4 class="list-group-item" style="color:darkgreen;">
                        <i class="fas fa-grip-vertical"></i> COURSES
                    </h4>
                    <ul class="list-group">
                        <?php
                        $sql_c = "SELECT * FROM courses ORDER BY id DESC";
                        $query_c = mysqli_query($connection, $sql_c);
                        while ($result_c = mysqli_fetch_assoc($query_c)) {
                        ?>
                            <li class="list-group-item bg-light" style="background-color:#FF6347;">
                                <i class="fas fa-chevron-circle-right" style="color:darkgreen;"></i>
                                <a href="course-category.php?course_category_id=<?php echo $result_c["id"]; ?>" class="btn">
                                    <?php echo $result_c["name"] ?></a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php require './pages/footer-home.php'; ?>

</div>


<?php require "inc/footer.php"; ?>