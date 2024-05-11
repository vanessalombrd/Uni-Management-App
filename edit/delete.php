<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DELETE BEFORE</title>
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
</style>
<body>
    <div>
        <div class="border">
            <form action="deleted.php" method="post">
                <p class="white" id="d">ИЗТРИЙ ОЦЕНКА</p><br>
                <p class="white">Студент № </p>
                <input type="number" name="facultyNumber" placeholder="Пр: 22621709">
                <p class="white">Дисциплина </p>
                <input type="text" name="course" placeholder="Пр: ООП1"><br><br>

                <input type="submit" name="submit" value="изтрий">
                
            </form>
        </div>
        <div class="bottom">
            <a href="../index.php"><button class='home'></button></a>
        </div>
    </div>
</body>
</html>