<?php

require_once 'Publication.php';

class Book extends Publication
{
    private string $author;

    public function __construct(string $title, int $year, string $author)
    {
        parent::__construct($title, $year);

        $this->author = $author;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function getInfo(): string
    {
        return "Книга: " . $this->getTitle()
            . ", автор: " . $this->author
            . ", год: " . $this->getYear();
    }
}