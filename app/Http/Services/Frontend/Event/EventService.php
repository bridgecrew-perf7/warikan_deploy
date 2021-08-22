<?php


namespace App\Http\Services\Frontend\Event;


use App\Http\Repositories\Event\EventRepositoryContract;
use App\Http\Repositories\Event\Params\EventParams;
use App\Models\Event;
use Illuminate\Support\Collection;

class EventService implements EventServiceContract
{
    private EventRepositoryContract $eventRepository;

    /**
     * EventService constructor.
     * @param  EventRepositoryContract  $eventRepository
     */
    public function __construct(EventRepositoryContract $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * @inheritdoc
     */
    public function fetchAllEvents(): Collection
    {
        return $this->eventRepository->fetchAllEvents();
    }

    /**
     * @inheritdoc
     */
    public function findEvent(int $eventId): Event
    {
        return $this->eventRepository->findEvent($eventId);
    }

    /**
     * @inheritdoc
     */
    public function storeEvent(EventParams $params): Event
    {
        return $this->eventRepository->storeEvent($params);
    }

    /**
     * @inheritdoc
     */
    public function updateEvent(Event $event, EventParams $params): void
    {
        $this->eventRepository->updateEvent($event, $params);
    }

    /**
     * @inheritdoc
     */
    public function deleteEvent(int $eventId): void
    {
        $this->eventRepository->deleteEvent($eventId);
    }

    /**
     * @inheritdoc
     */
    public function changeSettlement(Event $event): Event
    {
        return $this->eventRepository->changeSettlement($event);
    }
}
