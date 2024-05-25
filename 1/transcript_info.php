<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1 AFTER</title>
    <link rel="stylesheet" href="../buttons.css">
    <link rel="stylesheet" href="../body.css">
</head>
<style>
    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .top {
        display: flex;
        justify-content: space-between;
        /* width: 28%; */
        width: 550px;
    }

    .info1, .info2 {
        background-color: #D3D9D4;
        /* background-image: url("../paper.jpg"); */
        margin-top: 10px;
        padding: 20px;
        border-radius: 20px;
    }

    .transcript {
        background-color: #D3D9D4;
        /* background-image: url("../paper.jpg"); */
        margin: 50px;
        padding: 20px;
        border-radius: 20px;
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

    div.border {
        border: 1px solid white;
        border-radius: 20px;
        padding: 20px;
    }

    /* button {
        margin: 0 2px;
    } */

</style>
<body>
<?php
    include("../connection/config.php");
    include("../grade.php");

    if(isset($_POST["submit"])) {
        if(!empty($_POST["facultyNumber"])) {
            $facultyNumber = $_POST["facultyNumber"];

            $sql = "SELECT 
                id, firstName, middleName, surname, degree_id, `year`, email, `address` 
                FROM student 
                WHERE id = $facultyNumber";

            $result = mysqli_query($conn, $sql);

            echo "<div class='container'>";
            echo "<p class='white'><b>АКАДЕМИЧНА СПРАВКА</b></p><br>";
            echo "<div class='top'>";
            

            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='info1'>";
                    echo "Факултетен номер: " . $row["id"];
                    echo "<br>Име: " . $row["firstName"] . " " . $row["middleName"] . " " . $row["surname"];
                    echo "<br>Специалност: " . $row["degree_id"];
                    echo "<br>Курс на обучение: " . $row["year"];
                    echo "</div>";
                    echo "<div class='info2'>";
                    echo "<br>Адрес: " . $row["address"];
                    echo "<br>Email: " . $row["email"];
                    echo "</div>";
                }
            }

            echo "</div>"; // top

            $sql = "SELECT 
                c.name course_name, t.name title_name, l.name lecturer_name, 
                gi.name grade_name, c.semester semester, g.id grade_number
                FROM grade g
                JOIN course c ON c.id = g.course_id
                JOIN lecturer l ON l.id = g.lecturer_id
                JOIN grade_info gi ON gi.id = g.id
                JOIN title_info t ON t.id = l.title_id
                WHERE student_id = $facultyNumber
                ORDER BY g.date";

            $result = mysqli_query($conn, $sql);

            $counter = 1;

            if(mysqli_num_rows($result) > 0) {
                $prevSemester = null;
                echo "<div class='transcript'>";
                echo "<br><table border=0><tr><th>№</th><th>Дисциплина</th><th>Преподавател</th>";
                echo "<th colspan=2>Оценка</th>";
                while($row = mysqli_fetch_assoc($result)) {
                    if ($prevSemester !== $row["semester"])
                        echo "<tr><td colspan='5' align='center'>&nbsp;</td></tr>";
                    echo "<tr>";
                    echo "<td>" . $counter++ . ".</td>";
                    echo "<td>" . $row["course_name"] . "&nbsp;&nbsp;&nbsp;</td>";
                    echo "<td>" . $row["title_name"] . " " . $row["lecturer_name"] . "&nbsp;&nbsp;</td>";
                    echo "<td>" . $row["grade_name"] . "</td>";
                    echo "<td align=center>" . $row["grade_number"] . "</td>";
                    echo "</tr>";
                    $prevSemester = $row["semester"];
                }             
            }
            

            $sql = "SELECT 
                s.firstName student_name, 
                AVG(g.id) average_grade
                FROM grade g
                JOIN student s ON s.id = g.student_id
                WHERE student_id = $facultyNumber
                GROUP BY s.firstName;";

            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td colspan=5><hr></td></tr>";
                    echo "<tr><td colspan=3 align='right'>Средна оценка:&nbsp;</td>";
                    echo "<td>". grade_name($row["average_grade"]) . "</td>";
                    echo "<td colspan=1 align='right'>" . sprintf("%.2f", $row["average_grade"]) . "</td></tr>";
                }
                echo "</table>";
                echo "</div>"; // transcript
            }
            else {
                ?></body><body class='center'><?php
                echo "<div class='border white'>";
                echo "<p align='center'>Грешен факултетен номер!";
                echo "</p></div>";
            }
        }
        else {
            ?></body><body class='center'><?php
            echo "<div class='container'>";
            echo "<div class='border white'>";
            echo "<p align='center'>Моля, попълнете <br>всички задължителни полета!";
            echo "</p></div>";
        }
    }
    mysqli_close($conn);
?>
<div class="bottom">
    <a href="transcript.html"><button class='back'></button></a>
    <a href="../index.php"><button class='home'></button></a>
</div>
</div> <!--container-->
</body>
</html>
