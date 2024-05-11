<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2 AFTER</title>
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

    .info {
        /* background-color: #D3D9D4; */
        background-image: url("../paper.jpg");
        margin: 10%;
        padding: 20px;
        border-radius: 20px;
    }

    li {
        margin-bottom: 20px;
    }

    .white {
        text-align: center;
    }
</style>
<body>
<?php
    include("../connection/config.php");

    if(isset($_POST["submit"])) {
        if(!empty($_POST["course"])) {
            $course = $_POST["course"];

            $sql = "SELECT c.name course
                FROM course c
                WHERE c.id = '$course'";

            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $courseExists = $row;
            if ($row != 0)
                $courseName = mb_strtoupper($row["course"]);

            $sql = "SELECT  t.name title, l.name lecturer, l.phone phone, l.email email, d.name department
                FROM course_lecturer cl
                JOIN lecturer l ON l.id = cl.lecturer_id
                JOIN title_info t ON t.id = l.title_id
                JOIN department_info d ON d.id = l.department_id
                WHERE cl.course_id = '$course'";

            $result = mysqli_query($conn, $sql);

            $counter = 1;

            echo "<div class='container'>";

            echo "<p class='white'><b>ПРЕПОДАВАТЕЛИ</b>";
            if ($courseExists != 0)
                echo "<b> ПО<br><br>" . $courseName . "</b><br>";
            echo "</p>";
            
            if(mysqli_num_rows($result) > 0) {
                echo "<div class='info'>";
                echo "<ul>";
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<li>";
                    echo "<b>". $row["title"] . " " . $row["lecturer"] . "</b><br>";
                    echo $row["department"] . "<br>";
                    echo (!empty($row["phone"])) ? "Тел.: " . $row["phone"] : "";
                    echo (!empty($row["email"])) ? "Email: " . $row["email"] : "";
                    echo "</li>";
                };
                echo "</ul>";
                echo "</div>"; // info
            }
            else {
                echo "<div class='border white'>";
                echo "<p align='center'>Няма такава<br>дисциплина!";
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
        <a href="lecturersByCourses.html"><button class='back'></button></a>
        <a href="../index.php"><button class='home'></button></a>
    </div>
</div> <!-- container -->
</body>
</html>
