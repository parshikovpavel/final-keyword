<?php

namespace ppFinal\ApplyingFinalKeyword\PreferInterfaceImplementation;

use ppFinal\Comment;

/**
 * Simple block of comments
 */
final class SimpleCommentBlock implements CommentBlock
{
    /**
     * @var Comment[] Array of comments
     */
    protected $comments = [];

    /**
     * @inheritDoc
     */
    public function viewComment(string $key): string
    {
        return $this->comments[$key]->view();
    }

    /**
     * @inheritDoc
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
