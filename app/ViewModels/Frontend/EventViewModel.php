<?php


namespace App\ViewModels\Frontend;


use App\Models\Event;
use App\ViewModels\Base\ViewModel;
use Illuminate\Support\Collection;

class EventViewModel extends ViewModel
{
    private Event $event;

    /**
     * EventViewModel constructor.
     * @param  Event  $event
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * @param  Collection|Event[]  $events
     * @return Collection|EventViewModel[]
     */
    public static function collect(Collection $events): Collection
    {
        return $events
            ->map(fn ($event) => new self($event));
    }

    /**
     * @inheritDoc
     */
    public function toMap(): array
    {
        return [
            'id' => $this->event->id,
            'title' => $this->event->title,
            'created_at' => date('Y/m/d',  strtotime($this->event->created_at)),
        ];
    }
}
