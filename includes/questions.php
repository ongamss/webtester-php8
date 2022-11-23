<?php

    function getQuestions($testID)
    {
        $link = mysqli_connect("localhost", "u-webtester", "jachupouxibiu1", "webtester");
        if ($testID != "") {
			$query = "select ID, QuestionText from questions WHERE TestID=" . $testID . " order by sortOrder ASC, ID ASC";
		} else {
			$query = 'select ID, QuestionText from questions order by sortOrder ASC, ID ASC';
		}
        $result = mysqli_query($link, $query);
        $questions = array();
        while ($row = mysqli_fetch_object($result)) {
            $questions[$row->ID] = $row->QuestionText;
        }
 
        return $questions;
    }
?>
<?php
    function processQuestionsOrder($key)
    {
        if (!isset($_POST[$key]) || !is_array($_POST[$key]))
            return;
 
        $questions = getQuestions();
        $queries = array();
        $ranking = 1;
 
        foreach ($_POST[$key] as $question_id) {
            if (!array_key_exists($question_id, $questions))
                continue;
 
            $query = sprintf('update questions set sortOrder = %d where ID = %d',
                             $ranking,
                             $question_id);
 
            mysqli_query($query);
            $ranking++;
        }
    }
?>