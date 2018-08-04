<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use TMBCCodingChallenge\Model\Comment;
use TMBCCodingChallenge\Model\Comments;
 
final class CommentsTest extends TestCase{

    public function testCanFindComment(){

      // Build comment data structure
      $rootComment = new Comment(null, 'root', 'root');

      $comment1 = new Comment($rootComment, 'name 1', 'comment 1');
      $comment2 = new Comment($rootComment, 'name 2', 'comment 2');
      $comment3 = new Comment($rootComment, 'name 3', 'comment 3');
      $comment4 = new Comment($rootComment, 'name 4', 'comment 4');
      $comment5 = new Comment($comment1, 'name 5', 'comment 5');
      $comment6 = new Comment($comment1, 'name 6', 'comment 6');
      $comment7 = new Comment($comment5, 'name 7', 'comment 7');
      $comment8 = new Comment($comment6, 'name 8', 'comment 8');
      $comment9 = new Comment($comment8, 'name 9', 'comment 9');

      $comments = new Comments($rootComment);

      // Find a comment from comments
      [$depth, $searchComment5] = $comments->find($comment5->id);

      // Compare 2 comments
      $this->assertEquals($searchComment5, $comment5);

      // comment5 is placed in root -> comment1 -> comment 5
      $this->assertEquals(2, $depth);
    }
}



