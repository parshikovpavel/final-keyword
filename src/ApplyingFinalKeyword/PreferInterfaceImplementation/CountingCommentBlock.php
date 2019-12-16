<?php

namespace ppFinal\ApplyingFinalKeyword\PreferInterfaceImplementation;

use ppCache\CounterInterface;
use ppFinal\Comment;

/**
 * Block of comments counting views
 */
final class CountingCommentBlock implements CommentBlock
{
    /**
     * @var Comment[] Array of comments
     */
    protected $comments = [];

    /**
     * @var CounterInterface PSR-16 compatible cache
     */
    private $cache;

    /**
     * CountingCommentBlock constructor
     *
     * @param CounterInterface $cache
     */
    public function __construct(CounterInterface $cache)
    {
        $this->cache = $cache;
    }
    /**
     * Returns a string view of the comment and increments the counter value in the cache
     *
     * @param string $key
     * @return string
     */
    public function viewComment(string $key): string
    {
        $this->cache->increment($key);
        return $this->comments[$key]->view();
    }

    /**
     * Returns a string view of all comments in the block as a single string
     * and increments the counter values in the cache
     *
     * @return string
     */
    public function viewComments(): string
    {
        $view = '';
        foreach ($this->comments as $key => $comment) {
            $view .= $this->viewComment($key);
        }
        return $view;
    }
}
