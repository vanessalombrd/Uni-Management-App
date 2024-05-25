<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE AFTER</title>
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
        background-color: #D3D9D4;
        /* background-image: url("../paper.jpg"); */
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
</style>
<body>
<?php
    if(isset($_POST["submit"])) {
        include("../connection/config.php");
        if (!empty($_POST["facultyNumber"]) && !empty($_POST["course"]) 
        && !empty($_POST["grade"])) {

            $facultyNumber = $_POST["facultyNumber"];
            $course = $_POST["course"];
            $grade = $_POST["grade"];

            $sql = "UPDATE grade SET id='$grade'
            WHERE student_id='$facultyNumber' AND course_id='$course';";

            try {
                $result = mysqli_query($conn, $sql);
            } catch (Exception $e) {}
            
            if (mysqli_affected_rows($conn) > 0) {
                include("output.php");
            } else {
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
        <a href="update.php"><button class='back'></button></a>
        <a href="../index.php"><button class='home'></button></a>
    </div>
</div> <!-- container -->
</body>
</html>