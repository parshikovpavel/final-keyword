<?php

namespace ppFinal\ApplyingFinalKeyword\TemplateMethodPattern;

use ppCache\CounterInterface;

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
     * @param int $key
     * @return string
     */
    public function viewComment(int $key): string
    {
        $this->cache->inc($key);
        return $this->comments[$key]->view();
    }
}
