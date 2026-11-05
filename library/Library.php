<?php

require_once 'Publication.php';

class Library
{
    private array $publications = [];

    public function addPublication(Publication $publication): void
    {
        $this->publications[] = $publication;
    }

    public function getAllPublications(): array
    {
        return $this->publications;
    }

    public function search(
        ?string $title = null,
        ?string $author = null,
        ?int $year = null
    ): array {
        $result = [];

        foreach ($this->publications as $publication) {

            if (
                $title !== null &&
                stripos($publication->getTitle(), $title) === false
            ) {
                continue;
            }

            if (
                $author !== null &&
                stripos($publication->getAuthor() ?? '', $author) === false
            ) {
                continue;
            }

            if (
                $year !== null &&
                $publication->getYear() !== $year
            ) {
                continue;
            }

            $result[] = $publication;
        }

        return $result;
    }

    public function getOldestPublication(): ?Publication
    {
        if (empty($this->publications)) {
            return null;
        }

        $oldest = $this->publications[0];

        foreach ($this->publications as $publication) {
            if ($publication->getYear() < $oldest->getYear()) {
                $oldest = $publication;
            }
        }

        return $oldest;
    }

    public function countByType(string $type): int
    {
        $count = 0;

        foreach ($this->publications as $publication) {
            if (get_class($publication) === $type) {
                $count++;
            }
        }

        return $count;
    }
}