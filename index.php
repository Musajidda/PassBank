<?php
session_start();



require "inc/process.php";
require "inc/header.php";

if (isset($_GET['query'])) {
    $query = mysqli_real_escape_string($connection, $_GET['query']);

    $sql = "SELECT * FROM questions WHERE 
            course_title LIKE '%$query%' OR 
            course_code LIKE '%$query%' OR 
            session LIKE '%$query%'";

    $result = mysqli_query($connection, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<p>{$row['course_title']} - {$row['course_code']} ({$row['session']})</p>";
    }
}
?>

<div class="container">
    <?php require './pages/header-home.php'; ?>
    <div class="container my-3">
        <form action="search.php" method="GET" class="d-flex justify-content-center">
            <input type="text" name="query" class="form-control w-50 me-2"
                placeholder="Search by course title, code or session..." required>
            <button type="submit" class="btn btn-success">Search</button>
        </form>
    </div>
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
    <df-messenger intent="WELCOME" chat-title="Neko" agent-id="f207b69c-5d4a-43a0-8401-d151f1b5879b" language-code="en">
    </df-messenger>
    <div class="container-fluid my-3">
        <img class="d-block mx-auto mb-4" src="./img/p1.PNG" style="border-radius: 15px" alt="" width="950"
            height="450">
        <div class="row">
            <div class="col-6">
                <div class="p-3 my-3 text-center">
                    <h3 class="display-5 fw-bold" style="color: darkgreen">PassBank</h3>
                    <div class="col-lg-6 mx-auto">
                        <p class="lead mb-4">A Platform for sharing pass questions, Quickly get access to all Pass
                            Questions in different courses and sessions.</p>
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="p-3 my-3 text-center">
                    <h3 class="display-5 fw-bold" style="color: darkgreen">Why Us</h3>
                    <div class="col-lg-6 mx-auto">
                        <p class="lead mb-4">offers a comprehensive question bank, verified content, and a supportive
                            community, making it the ideal platform. </p>
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">

                        </div>
                    </div>
                </div>
            </div>
            <img class="d-block mx-auto mb-4" src="./img/p2.PNG" style="border-radius:15px" alt="" width="950"
                height="450">

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
                                <a href="view-question.php?question_id=<?php echo $result["id"]; ?>"
                                    class="btn btn-sm text-light" style="background-color:darkgreen;"><i
                                        class="fas fa-eye"></i> View Question</a>
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
                        <i class="fas fa-grip-vertical"></i> DEPARTMENT
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
    <?php
require "inc/process.php";
require "inc/header.php";
?>

    <div class="container my-5">
        <h3 class="text-center text-success">Search Results</h3>

        <?php
    if (isset($_GET['query'])) {
        $query = mysqli_real_escape_string($connection, $_GET['query']);

        $sql = "SELECT * FROM questions 
                WHERE course_title LIKE '%$query%' 
                OR course_code LIKE '%$query%' 
                OR session LIKE '%$query%'";

        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<div class='row'>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "
                    <div class='col-4 mt-2'>
                        <div class='card'>
                            <div class='card-body'>
                                <h5 class='card-title'>{$row['course_title']}</h5>
                                <h5 class='card-title'>Course Code: {$row['course_code']}</h5>
                                <h5 class='card-title'>Session: {$row['session']}</h5>
                                <a href='view-question.php?question_id={$row['id']}' class='btn btn-sm text-light' style='background-color:darkgreen;'><i class='fas fa-eye'></i> View Question</a>
                            </div>
                        </div>
                    </div>
                ";
            }
            echo "</div>";
        } else {
            echo "<p class='text-danger text-center'>No results found for '<strong>$query</strong>'</p>";
        }
    } else {
        echo "<p class='text-warning text-center'>No search query provided.</p>";
    }
    ?>

    </div>

    <?php require "inc/footer.php"; ?>

    <?php require './pages/footer-home.php'; ?>

</div>


<?php require "inc/footer.php"; ?>