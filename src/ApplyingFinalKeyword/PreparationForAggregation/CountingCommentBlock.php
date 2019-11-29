<?php

namespace ppFinal\ApplyingFinalKeyword\PreparationForAggregation;

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
     * CountingCommentBlock constructor
     * @param CommentBlock $commentBlock
     */
    public function __construct(CommentBlock $commentBlock)
    {
        $this->commentBlock = $commentBlock;
    }

    /**
     * @inheritDoc
     */
    public function getCommentKeys(): array
    {
        /* ... */
    }

    /**
     * @inheritDoc
     */
    public function viewComment(string $key): string
    {
        /* ... */
    }

    /**
     * @inheritDoc
     */
    public function viewComments() : string
    {
        /* ... */
    }
}

