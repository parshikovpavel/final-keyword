<?php

namespace ppFinal\ApplyingFinalKeyword\PreferAggregation;

use ppFinal\Comment;

/**
 * Simple block of comments
 */
final class SimpleCommentBlock implements CommentBlock
{
    /**
     * @var Comment[] Array of comments
     */
    private $comments = [];

    /**
     * @inheritDoc
     */
    public function getCommentKeys(): array
    {
        return array_keys($this->comments);
    }

    /**
     * @inheritDoc
     */
    public function viewComment(string $key): string
    {
        return $this->comments[$key]->view();
    }

    /**
     * Method with changed implementation details
     *
     * {@inheritDoc}
     */
    public function viewComments(): string
    {
        $view = '';
        foreach($this->comments as $key => $comment) {
            /* Instead of `$this->viewComment()` calling direct call to the `view()` comment method is made */
            $view .= $this->comments[$key]->view();
        }
        return $view;
    }

    /**
     * New method
     * Returns a string view of a random comment
     *
     * @return string
     */
    public function viewRandomComment(): string
    {
        $key = array_rand($this->comments);
        return $this->comments[$key]->view();
    }

    /**
     * @inheritDoc
     */
    public function setComments(array $comments): void
    {
        $this->comments = $comments;
    }
}

