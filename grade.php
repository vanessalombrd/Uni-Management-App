<?php
    function grade_name($grade) {
        $grade_name = null;
        if ($grade >= 5.5) {
            $grade_name = "Отличен";
        } elseif ($grade >= 4.5) {
            $grade_name = "Мн. добър";
        } elseif ($grade >= 3.5) {
            $grade_name = "Добър";
        } elseif ($grade >= 3) {
            $grade_name = "Среден";
        } else {
            $grade_name = "Слаб";
        }
        return $grade_name;
    }
