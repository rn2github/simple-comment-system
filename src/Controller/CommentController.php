<?php

namespace TMBCCodingChallenge\Controller;

use Exception;
use TMBCCodingChallenge\Controller\ControllerInterface;
use TMBCCodingChallenge\Util;
use TMBCCodingChallenge\Model\Comments;

class CommentController implements ControllerInterface{

    public function index(){

        // Get values from payload
        $parentId = (int)$_POST['parentId'];
        $name     = $_POST['name'];
        $content  = $_POST['content'];

        // --------------------------------------
        // Requirement
        // --------------------------------------
        //
        // Input Validation
        try{
            if(!is_int($parentId))
               throw new Exception('Invalid Parent Id');

            if(0 >= strlen($name))
                throw new Exception('Empty Name' );

            if(0 >= strlen($content))
                throw new Exception('Empty Comment');

            $filteredName = filter_var($name, FILTER_SANITIZE_STRING);

            if(strlen($name) !== strlen($filteredName))
                throw new Exception('Invalid Name');

            $filteredContent = filter_var($content, FILTER_SANITIZE_STRING);

            if(strlen($content) !== strlen($filteredContent))
                throw new Exception('Invalid Comment');

        }catch(Exception $e){
            // Redirect to index page with error message
            header('Location: ' . $_SERVER['PHP_SELF'] . '?error=' . urlencode($e->getMessage()));
            return;
        }

        // Get comments from file
        $rootComment = Util::getCommentsFromFile();

        // Create Comments instance 
        $comments = new Comments($rootComment);

        try{
            // Call method to add a new comment
            $newComment = $comments->create($parentId, $name, $content);

            // Save comments to file
            Util::saveCommentsToFile($rootComment);
        }catch(Exception $e){
            // File permission denided/Other errors
            header('Location: ' . $_SERVER['PHP_SELF'] . '?error=' . urlencode($e->getMessage()));
            return;            
        }

        // Redirect to index page
        header('Location: ' . $_SERVER['PHP_SELF']);
    }
}
