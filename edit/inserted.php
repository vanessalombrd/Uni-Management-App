<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSERT AFTER</title>
    <link rel="stylesheet" href="../buttons.css">
    <link rel="stylesheet" href="../body.css">
    <link rel="stylesheet" href="../opening.css">
</head>
<style>
    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .paper {
        /* background-color: #D3D9D4; */
        background-image: url("../paper.jpg");
        margin: 50px;
        padding: 20px;
        border-radius: 20px;
    }

    p {
        text-align: center;
        padding-top: 50px;
    }

    p.error {
        padding-top: 0px;
    }

    body, html {
        height: 100%;
        margin: 0;
    }

    body.center {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<body>
<?php
    if(isset($_POST["submit"])) {
        include("../connection/config.php");
        if (!empty($_POST["facultyNumber"]) && !empty($_POST["course"]) && !empty($_POST["lecturer_id"]) 
        && !empty($_POST["grade"])) {

            $facultyNumber = $_POST["facultyNumber"];
            $course = $_POST["course"];
            $lecturer = $_POST["lecturer_id"];
            $grade = $_POST["grade"];

            $date = (!empty($_POST["date"])) ? $_POST["date"] : null;

            if ($date == null) {
                $sql = "INSERT INTO `grade`(`id`, `student_id`, `course_id`, `lecturer_id`) 
            VALUES ($grade,'$facultyNumber','$course', $lecturer)";
            } else {
                $sql = "INSERT INTO `grade`(`id`, `student_id`, `course_id`, `lecturer_id`, `date`) 
            VALUES ($grade,'$facultyNumber','$course', $lecturer, '$date')";
            }

            try {
                $result = mysqli_query($conn, $sql);
                include("output.php");
            } catch (Exception $e) {
                echo "<div class='container'>";
                echo "<div class='border white'>";
                echo "<p class='error' align='center'>Грешно въведени данни!";
                echo "</p></div>";
            }
            
        }
        else {
            echo "<div class='container'>";
            echo "<div class='border white'>";
            echo "<p class='error' align='center'>Моля, попълнете <br>всички задължителни полета!";
            echo "</p></div>";
        }
    }
    mysqli_close($conn);
?>
<div class="bottom">
        <a href="insert.php"><button class='back'></button></a>
        <a href="../index.php"><button class='home'></button></a>
    </div>
</div> <!-- container -->
</body>
</html>