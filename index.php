<?php

require __DIR__ . '/vendor/autoload.php';

// Config - set filepath to store comments
$GLOBALS['config'] = ['filepath_data_comments' =>  __DIR__ . '/data/comments.dat'];

use TMBCCodingChallenge\Controller\IndexController;
use TMBCCodingChallenge\Controller\CommentController;

// Router
switch($_REQUEST['path']){

    case "postComment":
        // Controller to add new comment
        $controller = new CommentController();
        break;

    default:
        // Anything else to render index page
        $controller = new IndexController();
}

// Pass to controller
$controller->index();

