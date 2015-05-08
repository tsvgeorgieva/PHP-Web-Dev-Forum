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
            $questionId = $_SESSION['currentQuestionId'];
            if ($this->db->createAnswer($content, $questionId, $this->getUsername())) {
                $this->addInfoMessage("Answer created.");
                $this->redirectToUrl('/questions/view/'. $questionId);
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