<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>5 AFTER</title>
    <link rel="stylesheet" href="../buttons.css">
    <link rel="stylesheet" href="../body.css">
    <link rel="stylesheet" href="../opening.css">
</head>
<style>
    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        /* text-align: center; */
    }

    .info {
        background-color: #D3D9D4;
        /* background-image: url("../paper.jpg"); */
        margin: 10%;
        padding: 20px;
        border-radius: 20px;
    }

    td {
        padding: 5px;
    }
</style>
<body>
<?php
    include("../connection/config.php");
    include("../grade.php");

    if(isset($_POST["submit"])) {
        if(!empty($_POST["course"])) {
            $course = $_POST["course"];

            $sql = "SELECT c.name course
                FROM course c
                WHERE c.id = '$course'";

            echo "<div class='container'>";

            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $courseExists = $row;
            echo "<p class='white' align='center'><b>ТОП 3 СТУДЕНТИ</b>";
            if ($row != 0)
                echo "<b> ПО<br><br>". mb_strtoupper($row["course"]) . "</b>";
            echo "</p>";

            $sql = "SELECT s.id id, s.degree_id degree, s.firstName `name`, s.surname surname, s.degree_id, AVG(g.id) average
            FROM student s
            JOIN grade g ON s.id = g.student_id
            WHERE g.course_id = '$course'
            GROUP BY s.id
            ORDER BY average DESC
            LIMIT 3;";

            $result = mysqli_query($conn, $sql);

            if ($courseExists != 0) {
                if(mysqli_num_rows($result) > 0) {
                echo "<div class='info'>";
                echo"<br><table border=0><tr><th>№</th><th>Име</th><th>Спец.</th><th colspan=2>Оценка</th>";
                echo "<tr><td colspan=4></td></tr>";
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td width=80px>" . $row["id"] . "</td>";
                    echo "<td width=200px>" . $row["name"] . " " . $row["surname"] . "</td>";
                    echo "<td width=50px>" . $row["degree"] . "</td>";
                    echo "<td width=90px>" . grade_name($row["average"]) . "</td>";
                    echo "<td width=60px align=center>" . sprintf("%.0f", $row["average"]) . "</td>";                    echo "</tr>";
                };
                echo "</table>";
                echo "</div>"; // info
                } 
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
        <a href="top3ByCourse.html"><button class='back'></button></a>
        <a href="../index.php"><button class='home'></button></a>
    </div>
</div> <!-- container -->
</body>
</html>
