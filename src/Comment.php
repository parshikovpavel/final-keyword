<?php

namespace ppFinal;

/**
 * Class of comment
 */
class Comment
{
    /**
     * @var int Key of comment
     */
    private $key;

    /**
     * @var string Content of comment
     */
    private $content;

    /**
     * Comment constructor
     *
     * @param int $key
     * @param string $content
     */
    public function __construct(string $content, ?int $key = null)
    {
        $this->content = $content;
        $this->key = $key;
    }

    /**
     * Get key of comment
     *
     * @return int
     */
    public function getKey(): int
    {
        return $this->key;
    }

    /**
     * Get a string view of the comment
     *
     * @return string
     */
    public function view(): string
    {
        return 'Comment content: ' . $this->content;
    }

}