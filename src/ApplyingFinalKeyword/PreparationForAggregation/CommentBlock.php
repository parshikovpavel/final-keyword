<?php

namespace ppFinal\ApplyingFinalKeyword\PreparationForAggregation;

/**
 * The interface of a comment block
 */
interface CommentBlock
{
    /**
     * Returns comment keys that the comment block contain
     *
     * @return array
     */
    public function getCommentKeys(): array;

    /**
     * Returns a string view of the comment to output to the template
     *
     * @param string $key
     * @return string
     */
    public function viewComment(string $key): string;

    /**
     * Returns a string view of all comments in the block as a single string
     *
     * @return string
     */
    public function viewComments(): string;
}
