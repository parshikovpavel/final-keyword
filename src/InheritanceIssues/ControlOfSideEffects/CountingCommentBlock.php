<?php

namespace ppFinal\InheritanceIssues\ControlOfSideEffects;

use ppFinal\Comment;
use ppCache\CounterInterface;

/**
 * Block of comments counting views
 */
class CountingCommentBlock extends CommentBlock
{
    /**
     * @var CounterInterface PSR-16 compatible cache
     */
    private $cache;

    /**
     * CountingCommentBlock constructor
     *
     * @param Comment[] $comments
     * @param CounterInterface $cache
     */
    public function __construct(array $comments, CounterInterface $cache)
    {
        parent::__construct($comments);
        $this->cache = $cache;
    }

    /**
     * Returns a string view of the comment and increments the counter value in the cache
     * @param string $key
     * @return string
     */
    public function viewComment(string $key): string
    {
        $this->cache->increment($key);
        return parent::viewComment($key);
    }
}
