<?php

namespace TMBCCodingChallenge\Controller;

use Exception;
use TMBCCodingChallenge\Controller\ControllerInterface;
use TMBCCodingChallenge\Model\Comments;
use TMBCCodingChallenge\Model\Comment;
use TMBCCodingChallenge\Util;
use TMBCCodingChallenge\View\View;

class IndexController implements ControllerInterface{

    public function index(){

        $error = '';

        // Get comments from file
        $rootComment = Util::getCommentsFromFile();

        // If comments are not created yet, create a new one
        // and save it to file
        if(!$rootComment){
            $rootComment = new Comment(null, 'root', 'root');

            try{
                Util::saveCommentsToFile($rootComment);
            }catch(Exception $e){
                $error = $e->getMessage() . "\n";
            }
        }

        $comments = new Comments($rootComment);

        // Get error message from query string
        $error .= filter_var($_GET['error'], FILTER_SANITIZE_STRING);

        // Call View for rendering
        $view = new View();
        $view->load(['comments' => $comments->get(), 'error' => $error]);
    }
}

