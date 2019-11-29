<?php

namespace ppFinal\ApplyingFinalKeyword\TemplateMethodPattern;

use ppCache\CounterInterface;

/**
 * Block of comments counting views
 */
final class CountingCommentBlock extends CommentBlock
{
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
}
