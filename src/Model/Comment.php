<?php

namespace TMBCCodingChallenge\Model;

class Comment{

    public $id;
    public $timestamp;

    // Requirement
    public $name;

    // Requreiment
    public $content;

    // --------------------------------------
    // Requirement
    // --------------------------------------
    // A comment can have other comments underneath
    // as this is nested comments
    public $children;

    function __construct($parent, $name, $content){

        $this->id = rand();
        $this->name = $name;
        $this->content = $content;
        $this->timestamp = time();

        if(!is_null($parent)){

            $parent->children[] = $this;

            // --------------------------------------
            // Requirement
            // --------------------------------------
            // Sort comments by timestamp.
            if(count($parent->children) > 1){
                usort($parent->children, function($a, $b){
                    return strcmp($b->timestamp, $a->timestamp);
                });
            }
        }
    }
}
