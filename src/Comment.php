<?php

namespace ppFinal;

/**
 * Class of comment
 */
class Comment
{
    /**
     * @var string|null Key of comment
     */
    private $key;

    /**
     * @var string Content of comment
     */
    private $content;

    /**
     * Comment constructor
     *
     * @param string $content
     * @param string|null $key
     */
    public function __construct(string $content, ?string $key = null)
    {
        $this->content = $content;
        $this->key = $key;
    }

    /**
     * Get key of comment
     *
     * @return string
     */
    public function getKey(): ?string
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