<?php

abstract class Publication
{
    private string $title;
    private int $year;

    public function __construct(string $title, int $year)
    {
        $this->title = $title;
        $this->year = $year;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getAuthor(): ?string
    {
        return null;
    }

    abstract public function getInfo(): string;
}