<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3 AFTER</title>
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

    if(isset($_POST["submit"])) {
        if(!empty($_POST["degree"]) && !empty($_POST["year"])) {
            $degree = $_POST["degree"];
            $year = $_POST["year"];

            $sql = "SELECT s.id id, s.firstName `name`, s.surname surname, AVG(g.id) average 
                FROM grade g
                JOIN student s ON s.id = g.student_id
                WHERE s.degree_id = '$degree'
                AND s.year = $year
                GROUP BY s.id
                ORDER BY average DESC;";

            $result = mysqli_query($conn, $sql);

            echo "<div class='container'>";

            echo "<p class='white' align='center'><b>СРЕДНИ ОЦЕНКИ НА СТУДЕНТИ</b>";
            if (mysqli_num_rows($result) > 0)
                echo "<br><br><b>СПЕЦИАЛНОСТ " . $degree . ", " . $year . ". КУРС</b><br>";
            echo "</p>";

            if(mysqli_num_rows($result) > 0) {
                echo "<div class='info'>";
                echo "<br><table border=0><tr><th>№</th><th>Име</th><th colspan=2>Оценка</th>";
                echo "<tr><td colspan=3></td></tr>";

                include("../grade.php");
                
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td width=80px>" . $row["id"] . "</td>";
                    echo "<td width=200px>" . $row["name"] . " " . $row["surname"] . "</td>";
                    echo "<td width=90px>" . grade_name($row["average"]) . "</td>";
                    echo "<td width=60px>" . sprintf("%.2f", $row["average"]) . "</td>";
                    // echo "<td>" . "Mn dobur" . " " . sprintf("%.2f", $row["average"]) . "</td>";
                    echo "</tr>";
                };
                echo "</table>";
                echo "</div>"; // info
            }
            else {
                echo "<div class='border white'>";
                echo "<p align='center'>Няма такава<br>специалност или курс!";
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
        <a href="avgByDegree&Year.html"><button class='back'></button></a>
        <a href="../index.php"><button class='home'></button></a>
    </div>
</div> <!-- container -->
</body>
</html>
