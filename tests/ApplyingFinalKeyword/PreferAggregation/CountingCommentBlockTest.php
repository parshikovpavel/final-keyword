<?php

namespace ppFinal\ApplyingFinalKeyword\PreferAggregation;

use PHPUnit\Framework\TestCase;
use ppFinal\Comment;
use ppCache\CountingCache;

final class CountingCommentBlockTest extends TestCase
{
    public function testCountsViewsOfComment(): void
    {
        $key = '5';

        $comments = [
            $key => new Comment('It\'s so nice. The cute kitten'),
        ];

        $cache = new CountingCache();

        $simpleCommentBlock = new SimpleCommentBlock();

        $countingCommentBlock = new CountingCommentBlock($simpleCommentBlock, $cache);

        $countingCommentBlock->setComments($comments);

        $view = $countingCommentBlock->viewComment($key);

        $this->assertEquals(1, $cache->get($key));

        $view = $countingCommentBlock->viewComments();

        $this->assertEquals(2, $cache->get($key));
    }
}