<?php

use \CS\Controller;

/**
 * Class App_Controller_IndexController
 */
class App_Controller_IndexController extends Controller
{

    public function indexAction ()
    {
        $comments = App_Model_Comment::getAll();

        $content = array();
        $content['comments'] = $comments;

        $this->view->render($content);
    }

    public function commentFormAction ()
    {
        $this->view->render();
    }

    public function saveAction()
    {
        if (!empty($_POST))
        {
            $data = json_decode($_POST['comment']);

            $comment = new App_Model_Comment($data);
            $content = array();

            $result = $comment->save();
            $content['result'] = $result;

            $this->view->render($content);
        }
    }

} 