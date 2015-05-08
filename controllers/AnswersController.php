<?php
/**
 * Created by PhpStorm.
 * User: Tsvetina
 * Date: 4.5.2015 г.
 * Time: 17:11
 */

class AnswersController extends BaseController{
    private $db;

    public function onInit() {
        $this->title = "Answers";
        $this->db = new AnswersModel();
    }

    public function index() {
    }

    public function create() {
        if ($this->isPost) {
            $content = $_POST['answer_content'];
            $questionId = $_POST['answer_questionId'];
            if ($this->db->createAnswer($content, $questionId)) {
                $this->addInfoMessage("Answer created.");
                $this->redirect('questions');
            } else {
                $this->addErrorMessage("Error creating answer.");
            }
        }
    }

    public function delete($id) {
        if ($this->db->deleteAnswer($id)) {
            $this->addInfoMessage("Answer deleted.");
        } else {
            $this->addErrorMessage("Cannot delete answer.");
        }
        $this->redirect('questions');
    }
}