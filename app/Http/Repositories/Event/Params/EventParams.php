<?php


namespace App\Http\Repositories\Event\Params;


/**
 * イベント
 * Class EventParams
 * @package App\Http\Repositories\Event\Params
 */
class EventParams
{
    private string $title;

    /**
     * EventParams constructor.
     * @param  string  $title
     */
    public function __construct(string $title)
    {
        $this->title = $title;
    }

    /**
     * 保存用の配列に変換する
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title,
        ];
    }
}
