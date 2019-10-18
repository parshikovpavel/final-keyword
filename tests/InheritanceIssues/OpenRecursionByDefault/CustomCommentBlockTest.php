<?php

namespace ppFinal\InheritanceIssues\OpenRecursionByDefault;

use PHPUnit\Framework\TestCase;
use ppFinal\Comment;

final class CustomCommentBlockTest extends TestCase
{
    public function testReturnsCorrectListOfComments(): void
    {
        $comments = [
            new Comment("That's great", 666),
            new Comment('Cheer up', 555),
        ];

        $customCommentBlock = new CustomCommentBlock($comments);

        $this->assertEquals($comments, $customCommentBlock->getComments());
    }
}