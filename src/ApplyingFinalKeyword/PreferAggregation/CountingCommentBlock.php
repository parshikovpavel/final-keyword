<?php

namespace ppFinal\ApplyingFinalKeyword\PreferAggregation;

use ppCache\CounterInterface;

/**
 * Block of comments counting views
 */
final class CountingCommentBlock implements CommentBlock
{
    /**
     * @var CommentBlock Decorated comment block
     */
    private $commentBlock;

    /**
     * @var CounterInterface PSR-16 compatible cache
     */
    private $cache;

    /**
     * CountingCommentBlock constructor
     * @param CommentBlock $commentBlock
     * @param CounterInterface $cache
     */
    public function __construct(CommentBlock $commentBlock, CounterInterface $cache)
    {
        $this->commentBlock = $commentBlock;
        $this->cache = $cache;
    }

    /**
     * @inheritDoc
     */
    public function getCommentKeys(): array
    {
        return $this->commentBlock->getCommentKeys();
    }

    /**
     * Returns a string view of the comment and increments the counter value in the cache
     *
     * @param int $key
     * @return string
     */
    public function viewComment(int $key): string
    {
        $this->cache->increment($key);
        return $this->commentBlock->viewComment($key);
    }

    /**
     * Returns a string view of all comments in the block as a single string
     * and increments the counter values in the cache
     *
     * @return string
     */
    public function viewComments() : string
    {
        $commentKeys = $this->getCommentKeys();
        foreach ($commentKeys as $commentKey) {
            $this->cache->increment($commentKey);
        }
        return $this->commentBlock->viewComments();
    }
}

