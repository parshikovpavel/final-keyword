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
    public function viewComment(int $key) : string
    {
        return $this->comments[$key]->view();
    }

    /**
     * @inheritDoc
     */
    public function viewComments(): string
    {
        $view = '';
        foreach($this->comments as $key => $comment) {
            $view .= $this->viewComment($key);
        }
        return $view;
    }
}

