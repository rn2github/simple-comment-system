<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use TMBCCodingChallenge\Model\Comment;
 
final class CommentTest extends TestCase{

    public function testCanCreateNewComment(){

        $rootComment = new Comment(null, 'root', 'root comment');

        $this->assertInstanceOf(Comment::class, $rootComment);

        $childComment = new Comment($rootComment, 'root', 'root comment');

        // Check to see if childComment is appended to rootComment
        $this->assertInstanceOf(Comment::class, $rootComment->children[0]);
        $this->assertEquals($rootComment->children[0], $childComment);
    }
}
