<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSERT BEFORE</title>
    <link rel="stylesheet" href="../body.css">
    <link rel="stylesheet" href="../opening.css">
    <link rel="stylesheet" href="../buttons.css">
</head>
<style>
    .border {
        text-align: center;
    }

    form input[type="date"] {
        width: 170px;
    }

    .new {
        color: beige;
        font-style: italic;
    }
</style>
<body>
    <div>
        <div class="border">
            <form action="inserted.php" method="post">
                <p class="white" id="d">ДОБАВИ ОЦЕНКА</p><br>
                <p class="white">Студент № </p>
                <input type="number" name="facultyNumber" placeholder="Пр: 22621709" id="facultyNumber">
                <p class="white">Дисциплина </p>
                <input type="text" name="course" placeholder="Пр: ООП1">
                <p class="white">Преподавател № </p>
                <input type="number" name="lecturer_id" placeholder="Пр: 23">
                <p class="white">Оценка </p>
                <input type="number" name="grade" placeholder="Пр: 3"><br> 
                <!-- optional  -->
                <p class="white"><i>Дата </i></p> 
                <input type="date" name="date" ><br><br>

                <input type="submit" name="submit" value="добави">
            </form>
        </div>
        <div class="bottom">
            <a href="../index.php"><button class='home'></button></a>
        </div>
    </div>
</body>
</html>
<?php

    // taka i ne gi polzvah :(

    function showStudent($facultyNumber) {
        include("../connection/config.php");

        $sql = "SELECT s.firstName `name`, s.surname surname
        FROM student s
        WHERE s.id = '$facultyNumber'";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $student = $row["name"] . " " . $row["surname"];
        return $student;
    }

    function showLecturer($id) {
        include("../connection/config.php");

        $sql = "SELECT t.name title, l.name `name`
        FROM lecturer l
        JOIN title_info t ON t.id = l.title_id
        WHERE l.id = '$id'";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $lecturer = $row["title"] . " " . $row["name"];
        return $lecturer;
    }
