<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4 AFTER</title>
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
        /* background-color: #D3D9D4; */
        background-image: url("../paper.jpg");
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
            echo "<p class='white' align='center'><b>СРЕДНИ ОЦЕНКИ</b>";
            if ($row != 0)
                echo "<b> ПО<br><br>". mb_strtoupper($row["course"]) . "</b></p>";

            $sql = "SELECT s.id id, s.firstName `name`, s.surname surname, AVG(g.id) average 
                FROM grade g
                JOIN student s ON s.id = g.student_id
                WHERE g.course_id = '$course'
                GROUP BY s.id
                ORDER BY average DESC;";

            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0) {
                echo "<div class='info'>";
                echo"<br><table border=0><tr><th>№</th><th>Име</th><th colspan=2>Оценка</th>";
                echo "<tr><td colspan=4></td></tr>";
                
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td width=80px>" . $row["id"] . "</td>";
                    echo "<td width=200px>" . $row["name"] . " " . $row["surname"] . "</td>";
                    echo "<td width=90px>" . grade_name($row["average"]) . "</td>";
                    echo "<td width=60px align=center>" . sprintf("%.0f", $row["average"]) . "</td>";
                    echo "</tr>";
                };
                
            }

            $sql = "SELECT AVG(student_average) total_average
                FROM (
                    SELECT AVG(g.id) student_average
                    FROM grade g
                    JOIN student s ON s.id = g.student_id
                    WHERE g.course_id = '$course'
                    GROUP BY s.id
                ) AS student_averages;";

            $result = mysqli_query($conn, $sql);

            if ($courseExists != 0) {
                if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td colspan=4><hr></td></tr>";

                    echo "<tr>";
                    echo "<td style='padding: 10px;' colspan=2 align='right'>Средна оценка: " . "</td>";
                    echo "<td>" . grade_name($row["total_average"]) . "</td>";
                    echo "<td align=center>" . sprintf("%.2f", $row["total_average"]) . "</td>";
                    echo "</tr>";
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
        <a href="avgByCourse.html"><button class='back'></button></a>
        <a href="../index.php"><button class='home'></button></a>
    </div>
</div> <!-- container -->
</body>
</html>
