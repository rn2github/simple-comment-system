<?php

namespace TMBCCodingChallenge\Model;

use Exception;
use TMBCCodingChallenge\Model\Comment;

class Comments{

    public $rootComment;

    function __construct($rootComment){
        $this->rootComment = $rootComment;
    }

    /**
     * Returns root Comment
     */
    public function get(){
        return $this->rootComment;
    }

    /**
     * Create a new comment, add it to comment data structure
     */
    public function create($parentId = null, $name, $content){

        if(is_null($parentId)){
            $comment = new Comment($this->rootComment, $name, $content);
            return $comment;
        }else{

            // Find a parent comment
            [$depth, $parentComment] = $this->find($parentId);

            if(0 > $depth)
                throw new Exception('Parent not found: ' . $parentId);

            // -----------------------------------
            // Requirement
            //------------------------------------
            //
            // Maximum of 3 levels in nested comments
            if(3 <= $depth)
                throw new Exception('Exceed max level of children: ' . $depth);

            // Add a new comment under a parent and as its child
            $comment = new Comment($parentComment, $name, $content);
        }

        return $comment;
    }

    /**
     * Find a comment by ID from comment data structure
     * @return array
     */
    public function find($id){
   
        $result = null;
        $resultDepth = 0;

        // Find a comment from comments recursively
        $_find = function($comment, $depth) use (&$_find, $id, &$result, &$resultDepth){

            // Comment is found, set the result
            if($comment->id == $id){
                $result = $comment;
                $resultDepth = $depth;
                return;

            }else if(count($comment->children) > 0){
                // If comment has children, search target comment in children
                foreach($comment->children as $childComment)
                    $_find($childComment, $depth+1);
            }
        };

        $_find($this->rootComment, 0);

        // If the comment is not found, it returns depth of -1 and null
        return $result === null ? [-1, null] : [$resultDepth, $result];
    } 
}



