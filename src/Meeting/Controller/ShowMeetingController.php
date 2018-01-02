<?php

declare(strict_types=1);

namespace Meeting\Controller;

use Application\Controller\ErrorController;
use Meeting\Exception\MeetingNotFoundException;
use Meeting\Repository\MeetingRepository;

final class ShowMeetingController
{
    /**
     * @var MeetingRepository
     */
    private $meetingRepository;

    public function __construct(MeetingRepository $meetingRepository)
    {
        $this->meetingRepository = $meetingRepository;
    }

    public function indexAction() : string
    {
        $meeting = $this->meetingRepository->getMeetingById($_GET['id'] ?? '');

        ob_start();
        include __DIR__.'/../../../views/meeting-details.phtml';
        return ob_get_clean();
    }
}
