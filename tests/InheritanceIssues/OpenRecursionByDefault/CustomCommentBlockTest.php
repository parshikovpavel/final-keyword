<?php

namespace ppFinal\InheritanceIssues\OpenRecursionByDefault;

use PHPUnit\Framework\TestCase;
use ppFinal\Comment;

final class CustomCommentBlockTest extends TestCase
{
    public function testReturnsCorrectListOfComments(): void
    {
        $comments = [
            new Comment(666, "That's great"),
            new Comment(555, 'Cheer up'),
        ];

        $customCommentBlock = new CustomCommentBlock($comments);

        $this->assertEquals($comments, $customCommentBlock->getComments());
    }
}