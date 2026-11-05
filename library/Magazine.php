<?php

require_once 'Publication.php';

class Magazine extends Publication
{
    private int $issueNumber;
    private string $periodicity;

    public function __construct(
        string $title,
        int $year,
        int $issueNumber,
        string $periodicity
    ) {
        parent::__construct($title, $year);

        $this->issueNumber = $issueNumber;
        $this->periodicity = $periodicity;
    }

    public function getInfo(): string
    {
        return "Журнал: " . $this->getTitle()
            . ", номер: " . $this->issueNumber
            . ", периодичность: " . $this->periodicity
            . ", год: " . $this->getYear();
    }
}