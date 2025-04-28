<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

// Includes
require "inc/process.php";
require "inc/header.php";

// Validate and fetch question
if (!isset($_GET["question_id"]) || empty($_GET["question_id"])) {
    header("Location: index.php");
    exit();
}

$id = (int) $_GET["question_id"]; // Cast to int for safety
$_SESSION["url"] = $id;

// Fetch question and course details
$question = getQuestionById($connection, $id);

if (!$question) {
    header("Location: index.php");
    exit();
}

$course = getCourseById($connection, $question['course_id']);

// Functions
function getQuestionById($conn, $id)
{
    $stmt = $conn->prepare("SELECT * FROM questions WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function getCourseById($conn, $id)
{
    $stmt = $conn->prepare("SELECT * FROM courses WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}
?>

<div class="container">
    <?php require './pages/header-home.php'; ?>

    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-8">
                <?php if (isset($error)): ?>
                <div class="alert alert-danger">
                    <strong><?= htmlspecialchars($error); ?></strong>
                </div>
                <?php elseif (isset($success)): ?>
                <div class="alert alert-success">
                    <strong><?= htmlspecialchars($success); ?></strong>
                </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-10 text-center">
                        <?php if (!empty($question['file_path'])): ?>
                        <img style="width:500px; height:500px;" src="<?= htmlspecialchars($question['file_path']); ?>"
                            alt="Question Image">
                        <br><br>
                        <a href="<?= htmlspecialchars($question['file_path']); ?>" download>
                            <button style="padding: 10px 20px; font-size: 16px;">Download Image</button>
                        </a>
                        <?php else: ?>
                        <p>No image available for this question.</p>
                        <?php endif; ?>
                    </div>

                    <div class="col-2">
                        <?php if ($course): ?>
                        <h6>COURSE: <?= htmlspecialchars($course['name']); ?></h6>
                        <h6>TITLE: <?= htmlspecialchars($course['course_title']); ?></h6>
                        <h6>CODE: <?= htmlspecialchars($course['course_code']); ?></h6>
                        <h6>SESSION: <?= htmlspecialchars($course['session']); ?></h6>
                        <?php else: ?>
                        <p>Course information not available.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require './pages/footer-home.php'; ?>
</div>

<?php require "inc/footer.php"; ?>