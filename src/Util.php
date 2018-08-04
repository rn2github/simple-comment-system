<?php

namespace TMBCCodingChallenge;

use Exception;
use TMBCCodingChallenge\Model\Comment;

class Util{

    static private function getFilename(){
        return $GLOBALS['config']['filepath_data_comments'];
    }

    /**
     * Get comments from file
     */
    static public function getCommentsFromFile(){
        $file = self::getFilename();
        $rootComment = unserialize(file_get_contents($file));
        return $rootComment;
    }

    /**
     * Save comemnts to file
     * throws Exception if file permission is not set properly
     */
    static public function saveCommentsToFile($rootComment){ // throws Exception
        $file = self::getFilename();
        $success = @file_put_contents($file, serialize($rootComment));

        if(!$success)
            throw new Exception('File Permission denied to save comments. Please check file permission');
    }

}
