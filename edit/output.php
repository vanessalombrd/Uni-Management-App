<?php

    $sql = "SELECT id id, firstName `name`, surname surname
        FROM student
        WHERE id = $facultyNumber";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    echo "<div class='container'>";
    echo "<p class='white'><b>ОЦЕНКИ НА <br><br>" . mb_strtoupper($row["name"]) . " " . mb_strtoupper($row["surname"]);
    echo "<br><br>№" . $facultyNumber . "</b></p><br>";


    $sql = "SELECT g.student_id id, gi.name grade_name, c.name course, c.id course_id, g.id grade, t.name title, l.name lecturer
                FROM grade g
                JOIN lecturer l ON l.id = g.lecturer_id
                JOIN title_info t ON t.id = l.title_id
                JOIN course c ON c.id = g.course_id
                JOIN grade_info gi ON gi.id = g.id
                WHERE student_id = '$facultyNumber'
                ORDER BY g.date";

    $result = mysqli_query($conn, $sql);

    $counter = 1;

    if(mysqli_num_rows($result) > 0) {
        echo "<div class='paper'>";
        echo"<br><table border=0><tr><th>№</th><th>Дисциплина</th><th>Преподавател</th><th colspan=2>Оценка</th>";
        echo "<tr><td colspan=5>&nbsp;</td></tr>";
        while($row = mysqli_fetch_assoc($result)) {
            $match = ($row["id"] == $_POST["facultyNumber"] && $row["course_id"] == $_POST["course"]);
            echo "<tr>";
            echo "<td>". bold1($match). $counter++ . "." . bold2($match). "</td>";
            echo "<td width=330px>" . bold1($match) .$row["course"] . bold2($match) ."</td>";
            echo "<td width=150px>" . bold1($match) . $row["title"] . " ". $row["lecturer"] . bold2($match) . "</td>";
            echo "<td>". bold1($match).  $row["grade_name"] . bold2($match). "</td>";
            echo "<td>". bold1($match). $row["grade"] . bold2($match). "</td>";
            echo "</tr>";
        };
        echo "</table>";
        echo "</div>"; // info
    }

    function bold1($match) {
        return ($match) ? "<b>" : "";
    }

    function bold2($match) {
        return ($match) ? "</b>" : "";
    }