<?php


namespace App\Http\Repositories\Event;

use App\Http\Repositories\Event\Params\EventParams;
use App\Models\Event;
use Illuminate\Support\Collection;

/**
 * イベント
 * Interface EventRepositoryContract
 * @package App\Http\Repositories\Event
 */
interface EventRepositoryContract
{
    /**
     * 全てのイベントを取得する
     * @return Collection|Event[]
     */
    public function fetchAllEvents(): Collection;

    /**
     * IDでイベントを取得する
     * @param  int  $eventId
     * @return Event
     */
    public function findEvent(int $eventId):Event;

    /**
     * イベントを追加する
     * @param  EventParams  $params
     * @return Event
     */
    public function storeEvent(EventParams $params): Event;

    /**
     * イベントを更新する
     * @param  Event  $event
     * @param  EventParams  $params
     */
    public function updateEvent(Event $event, EventParams $params): void;

    /**
     * イベントを削除する
     * @param  int  $eventId
     */
    public function deleteEvent(int $eventId): void;
}
