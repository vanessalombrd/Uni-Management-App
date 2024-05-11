<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATABASE</title>
    <link rel="stylesheet" href="../body.css">
    <link rel="stylesheet" href="../opening.css">
    <link rel="stylesheet" href="../buttons.css">
</head>
<style>
    .border {
        text-align: center;
        height: 120px;
    }
</style>
<body>
    <div>
        <div class="border">
            <form action="transcript_info.php" method="post">
                <p class="white">БАЗАТА ДАННИ<br><br>БЕШЕ СЪЗДАДЕНА<br><br>УСПЕШНО!</p><br>
            </form>
        </div>
        <div class="bottom">
            <a href="../index.php"><button class='home'></button></a>
        </div>
    </div>
</body>
</html>
<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $db_name = "university3";

    $conn = new mysqli($host, $username, $password);

    if ($conn->connect_errno) 
    { exit('Connect failed: '. $conn->connect_error);
    } 

    $sql = "CREATE DATABASE IF NOT EXISTS ".$db_name;

    if (!$conn->query($sql))
    { echo 'Error creating database: '. $conn->error;}

    $sql = "CREATE TABLE IF NOT EXISTS university3.degree_info (
        `id` varchar(5) NOT NULL,
        `name` varchar(50) NOT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        
        CREATE TABLE IF NOT EXISTS university3.department_info (
        `id` varchar(5) NOT NULL,
        `name` varchar(50) NOT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        
        CREATE TABLE IF NOT EXISTS university3.title_info  (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(15) NOT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        
        CREATE TABLE IF NOT EXISTS university3.grade_info (
        `id` int(11) NOT NULL,
        `name` varchar(20) NOT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        
        CREATE TABLE IF NOT EXISTS university3.lecturer (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(30) NOT NULL,
        `title_id` int(11) NOT NULL,
        `phone` varchar(15),
        `email` varchar(30),
        `department_id` varchar(5) NOT NULL,
        PRIMARY KEY (`id`),
        FOREIGN KEY (`title_id`) REFERENCES `title_info` (`id`),
        FOREIGN KEY (`department_id`) REFERENCES `department_info` (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        
        CREATE TABLE IF NOT EXISTS university3.course  (
        `id` varchar(5) NOT NULL,
        `name` varchar(50) NOT NULL,
        `semester` int(11) NOT NULL,
        `credits` int(11) NOT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        
        CREATE TABLE IF NOT EXISTS university3.student (
        `id` char(8) NOT NULL,
        `firstName` varchar(15) NOT NULL,
        `middleName` varchar(15),
        `surname` varchar(15) NOT NULL,
        `degree_id` varchar(5) NOT NULL,
        `year` int(11) NOT NULL,
        `email` varchar(30),
        `address` varchar(50),
        PRIMARY KEY (`id`),
        FOREIGN KEY (`degree_id`) REFERENCES `degree_info` (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        
        CREATE TABLE IF NOT EXISTS university3.grade  (
        `id` int(11) NOT NULL,
        `student_id` char(8) NOT NULL,
        `course_id` varchar(5) NOT NULL,
        `lecturer_id` int(11) NOT NULL,
        `date` date NOT NULL,
        PRIMARY KEY (`student_id`, `course_id`),
        FOREIGN KEY (`id`) REFERENCES university3.grade_info (`id`),
        FOREIGN KEY (`student_id`) REFERENCES university3.student (`id`),
        FOREIGN KEY (`course_id`) REFERENCES university3.course (`id`),
        FOREIGN KEY (`lecturer_id`) REFERENCES university3.lecturer (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        
        CREATE TABLE IF NOT EXISTS university3.course_lecturer (
        `course_id` varchar(5) NOT NULL,
        `lecturer_id` int(11) NOT NULL,
        PRIMARY KEY (`course_id`, `lecturer_id`),
        FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
        FOREIGN KEY (`lecturer_id`) REFERENCES `lecturer` (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    if (!$conn->multi_query($sql))
    { echo 'Error: '. $conn->error;}

    $conn->close();