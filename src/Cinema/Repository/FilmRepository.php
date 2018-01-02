<?php

declare(strict_types=1);

namespace Cinema\Repository;

use Cinema\Collection\FilmCollection;
use Cinema\Entity\Meeting;
use Cinema\Exception\MeetingNotFoundException;
use PDO;

final class FilmRepository
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function fetchAll() : FilmCollection
    {
        $result = $this->pdo->query('SELECT id, title FROM films');
        $films = [];
        while ($film = $result->fetch()) {
            $films[] = new Meeting($film['title']);
        }
        return new FilmCollection(...$films);
    }

    public function get(string $name) : Meeting
    {
        $statement = $this->pdo->prepare('SELECT id, title FROM films WHERE title = :name');
        $statement->execute([':name' => $name]);
        $film = $statement->fetch();
        if (!$film) {
            throw new MeetingNotFoundException();
        }
        return new Meeting($film['title']);
    }
}
