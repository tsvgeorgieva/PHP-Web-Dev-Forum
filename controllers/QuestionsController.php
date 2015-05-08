<?php

class QuestionsController extends BaseController {
    private $db;

    public function onInit() {
        $this->title = "Questions";
        $this->db = new QuestionsModel();
    }

    public function index() {
        $this->questions = $this->db->getAll();
    }

    public function view($id) {
        $this->question = $this->db->getById($id);
        $this->answers = $this->db->getAllAnswersForQuestion($id);
    }

    public function create() {
        if ($this->isPost) {
            $title = $_POST['question_title'];
            $content = $_POST['question_content'];
            $username = $this->getUsername();
            if ($this->db->createQuestion($title, $content, $username)) {
                $this->addInfoMessage("Question created.");
                $this->redirect('questions');
            } else {
                $this->addErrorMessage("Error creating question.");
            }
        }
    }

    public function delete($id) {
        if ($this->db->deleteQuestion($id)) {
            $this->addInfoMessage("Question deleted.");
        } else {
            $this->addErrorMessage("Cannot delete question.");
        }
        $this->redirect('questions');
    }
}