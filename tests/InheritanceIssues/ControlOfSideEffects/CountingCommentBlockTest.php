<?php

namespace ppFinal\InheritanceIssues\ControlOfSideEffects;

use PHPUnit\Framework\TestCase;
use ppFinal\Comment;
use ppCache\CountingCache;

final class CountingCommentBlockTest extends TestCase
{
    public function testCountsViewsOfComment(): void
    {
        $key = 0;

        $comments = [
            $key => new Comment('Hello! Glad to see you!'),
        ];

        $cache = new CountingCache();

        $countingCommentBlock = new CountingCommentBlock($comments, $cache);

        $view = $countingCommentBlock->viewComments();

        $this->assertEquals(1, $cache->get($key));
    }
}