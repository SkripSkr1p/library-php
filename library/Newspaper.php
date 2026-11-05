<?php

require_once 'Publication.php';

class Newspaper extends Publication
{
    private string $publisher;

    public function __construct(
        string $title,
        int $year,
        string $publisher
    ) {
        parent::__construct($title, $year);

        $this->publisher = $publisher;
    }

    public function getInfo(): string
    {
        return "Газета: " . $this->getTitle()
            . ", издательство: " . $this->publisher
            . ", год: " . $this->getYear();
    }
}