<?php

class AnswersModel extends BaseModel {
    public function createAnswer($content, $questionId) {
        if ($content == '' || is_null($questionId)) {
            return false;
        }
        $statement = self::$db->prepare(
            "INSERT INTO answers(content, question_id) VALUES(?, ?)");
        $statement->bind_param("si", $content, $questionId);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function deleteAnswer($id) {
        $statement = self::$db->prepare(
            "DELETE FROM answers WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
}