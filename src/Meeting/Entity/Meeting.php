<?php

declare(strict_types=1);

namespace Meeting\Entity;

final class Meeting
{
    /**
     * @var string
     */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function name() : string
    {
        return $this->name;
    }
}
