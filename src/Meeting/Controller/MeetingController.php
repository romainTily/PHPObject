<?php

declare(strict_types=1);

namespace Meeting\Controller;

use Meeting\Repository\MeetingRepository;

final class MeetingController
{
    /**
     * @var MeetingRepository
     */
    private $MeetingRepository;


    public function __construct(MeetingRepository $MeetingRepository)
    {
        $this->MeetingRepository = $MeetingRepository;
    }

    public function indexAction() : string
    {
        $meetings = $this->MeetingRepository->fetchAll();
        ob_start();
        include __DIR__.'/../../../views/meeting.phtml';
        return ob_get_clean();
    }
}
