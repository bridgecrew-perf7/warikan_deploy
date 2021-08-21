<?php


namespace App\Http\Services\Frontend\Event;


use App\Http\Repositories\Event\Params\EventParams;
use App\Models\Event;
use Illuminate\Support\Collection;

interface EventServiceContract
{
    /**
     * すべてのイベントを取得する
     * @return Collection|Event[]
     */
    public function fetchAllEvents(): Collection;

    /**
     * IDでイベントを取得
     * @param  int  $eventId
     * @return Event
     */
    public function findEvent(int $eventId): Event;

    /**
     * イベントを登録する
     * @param  EventParams  $params
     * @return Event
     */
    public function storeEvent(EventParams $params): Event;

    /**
     * イベントを更新する
     * @param  Event  $event
     * @param  EventParams  $params
     * @return void
     */
    public function updateEvent(Event $event, EventParams $params): void;

    /**
     * @param  int  $eventId
     * @return void
     */
    public function deleteEvent(int $eventId): void;
}
