<?php
require "inc/process.php";
require "inc/header.php";
?>

<div class="container my-5">
    <nav class="navbar navbar-light rounded sticky-top" style="background-color:darkgreen;">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="index.php">
                <h5> <i class="fas fa-bars"></i> Pass Question Platform </h5>

            </a>
            <div class="d-flex">

            </div>
        </div>
    </nav>
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