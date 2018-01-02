<?php

declare(strict_types=1);

namespace Meeting\Repository;

use Meeting\Collection\MeetingCollection;
use Meeting\Entity\Meeting;
use Meeting\Exception\MeetingNotFoundException;
use PDO;

final class MeetingRepository
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function fetchAll() : MeetingCollection
    {
        $result = $this->pdo->query('SELECT title FROM meeting;');
        $meetings = [];
        while ($meeting = $result->fetch()) {
            $meetings[] = new Meeting($meeting['title']);
        }
        return new MeetingCollection(...$meetings);
    }

    public function getMeetingById(string $name) : Meeting
    {
        $statement = $this->pdo->prepare('SELECT title FROM meeting WHERE title = :name');
        $statement->execute([':name' => $name]);
        $meeting = $statement->fetch();

        if (!$meeting) {
            throw new MeetingNotFoundException();
        }

        return new Meeting($meeting['title']);
    }

    public function signUp(string $name, int $idUser, int $idMeeting) : void
    {
        $statement = $this->pdo->prepare(INSERT INTO participation(idUser, idMeeting) VALUES(:idUser, :idMeeting););
        $statement->execute([':idUser' => $idUser, '$idMeeting'=>$idMeeting]);
    }

    public function addHost(int $idUser, int $idMeeting) : void
    {
        $statement = $this->pdo->prepare( UPDATE meeting SET host=:idUser WHERE id=:idMeeting;);
        $statement->execute([':idUser' => $idUser, '$idMeeting'=>$idMeeting]);
    }

    public function delMeeting(int $idMeeting) : void
    {
        $statement = $this->pdo->prepare('DELETE FROM meeting WHERE id=:idMeeting;');
        $statement->execute(['$idMeeting'=>$idMeeting]);
    }



}
