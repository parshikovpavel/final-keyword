<?php

namespace ppFinal\ApplyingFinalKeyword\TemplateMethodPattern;

/**
 * Simple block of comments
 */
final class SimpleCommentBlock extends CommentBlock
{
    /**
     * @inheritdoc
     */
    public function viewComment(int $key): string
    {
        return $this->comments[$key]->view();
    }
}
