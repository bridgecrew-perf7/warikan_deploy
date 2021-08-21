<?php


namespace App\Http\Repositories\Event;

use App\Http\Repositories\Event\Params\EventParams;
use App\Models\Event;
use Illuminate\Support\Collection;

/**
 * イベント
 * Class EventRepository
 * @package App\Http\Repositories\Event
 */
class EventRepository implements EventRepositoryContract
{
    /**
     * @inheritdoc
     */
    public function fetchAllEvents(): Collection
    {
        return Event::orderByDesc('created_at')->get();
    }

    /**
     * @inheritdoc
     */
    public function findEvent(int $eventId): Event
    {
        return Event::findOrFail($eventId);
    }

    /**
     * @inheritdoc
     */
    public function storeEvent(EventParams $params): Event
    {
        return Event::create($params->toArray());
    }

    /**
     * @inheritdoc
     */
    public function updateEvent(Event $event, EventParams $params): void
    {
        $event->update($params->toArray());
    }

    /**
     * @inheritdoc
     */
    public function deleteEvent(int $eventId): void
    {
        Event::findOrFail($eventId)->delete();
    }
}
