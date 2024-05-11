<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DELETE AFTER</title>
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
        padding-top: 100px;
    }

    p.error {
        padding-top: 0px;
    }

    #idk {
        padding-top: 0px;
    }

</style>
<body>
<?php
    if(isset($_POST["submit"])) {
        include("../connection/config.php");
        if (!empty($_POST["facultyNumber"]) && !empty($_POST["course"])) {

            $facultyNumber = $_POST["facultyNumber"];
            $course = $_POST["course"];

            if(isValidFK($conn, $facultyNumber) && isValidCourse($conn, $course)) {
                $sql = "SELECT c.name course, g.id grade
                FROM grade g
                JOIN course c ON c.id = g.course_id
                JOIN student s ON s.id = g.student_id
                WHERE c.id = '$course' AND s.id = '$facultyNumber'";

                try {
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    //$deleted = $row["course"];
                } catch (Exception $e) {}
                

                $sql = "DELETE FROM grade
                WHERE student_id = '$facultyNumber' AND course_id = '$course';";

                try {
                    $result = mysqli_query($conn, $sql);
                } catch (Exception $e) {}
                
                if (mysqli_affected_rows($conn) > 0) {
                    include("output.php");

                    $sql = "SELECT c.name course_name, g.id grade
                        FROM grade g
                        JOIN course c ON c.id = g.course_id
                        JOIN student s ON s.id = g.student_id
                        WHERE c.id = '$course' AND s.id = '$facultyNumber'";

                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);

                    echo "<p class=white id=idk>Оценката по <br>";
                    echo $course . "<br>беше изтрита.</p>";
                } 
                else {
                    echo "<div class='container'>";
                    echo "<div class='border white'>";
                    echo "<p class='error' align='center'>Тези данни не съществуват<br>и не могат<br>да бъдат изтрити!";
                    echo "</p></div>";
                }
                
            }
            else {
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

    function isValidFK($conn, $id) {
        $sql = "SELECT * FROM student WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        return mysqli_num_rows($result) > 0;
    }
    function isValidCourse($conn, $id) {
        $sql = "SELECT * FROM course WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        return mysqli_num_rows($result) > 0;
    }
?>
<div class="bottom">
        <a href="delete.php"><button class='back'></button></a>
        <a href="../index.php"><button class='home'></button></a>
    </div>
</div> <!-- container -->
</body>
</html>