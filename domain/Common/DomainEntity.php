<?php

declare(strict_types=1);

namespace Domain\Common;

abstract class DomainEntity
{
    private array $events = [];

    public function addEvent(DomainEvent $event): void
    {
        $this->events[] = $event;
    }

    public function popEvents(): array
    {
        $events = $this->events;

        $this->events = [];

        return $events;
    }
}
