<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="body.css">
    <link rel="stylesheet" href="buttons.css">
    <link rel="stylesheet" href="opening.css">
</head>
<style>
    button {
        width: 100%;
    } 

    div {
        margin: 0 10px;
    }

    .container {
        display: flex;
        justify-content: center;
    }

    .left-column {
        display: flex;
        flex-direction: column;
    }

    .right-column {
        margin-left: 20px;
    }

    .box {
        width: 250px; 
        margin-bottom: 23px; 
    }

    #first {
        height: 160px;
    }

    #second {
        height: 215px; 
    }

</style>
<body>
    <div class='container'>
        <div class='left-column'>
            <div class="border box" id="first">
                <p class="white" style="text-align: center; ">БАЗА ДАННИ</p><br>
                <a href="connection/create.php"><button>Създаване на база данни</button></a><br><br>
                <a href="connection/data.php"><button>Автоматично добавяне на данни</button></a><br>
            </div>
            <div class="border box" id="second">
                <p class="white" style="text-align: center;">МАНИПУЛАЦИЯ НА ДАННИ</p><br>
                <a href="edit/insert.php"><button>Въвеждане</button></a><br><br>
                <a href="edit/update.php"><button>Корекция</button></a><br><br>
                <a href="edit/delete.php"><button>Изтриване</button></a><br><br>
            </div>
        </div>
        <div class='right-column'>
            <div class="border">
                <p class="white" style="text-align: center;">СПРАВКИ</p><br>
                <a href="1/transcript.html"><button>1. Академична справка</button></a><br><br>
                <a href="2/lecturersByCourses.html"><button>2. Информация за преподаватели,<br>преподаващи конкретна дисциплина</button></a><br><br>
                <a href="3/avgByDegree&Year.html"><button>3. Среден успех за студенти<br>по специалност и курс</button></a><br><br>
                <a href="4/avgByCourse.html"><button>4. Среден успех за дисциплина</button></a><br><br>
                <a href="5/top3ByCourse.html"><button>5. Топ 3 класация на отличници<br>по зададена дисциплина</button></a><br><br>
                <a href="6/over5.html"><button>6. Студентите от конкретна специалност,<br>имащи успех над 5.00</button></a><br>
            </div>
        </div>
    </div>
</body>
</html>