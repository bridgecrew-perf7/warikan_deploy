<?php


namespace App\Http\Repositories\Payment\Params;


class PaymentParams
{
    private int $eventId;
    private int $payerId;
    private string $title;
    private int $price;
    private string $memo;

    /**
     * PaymentParams constructor.
     * @param  int  $eventId
     * @param  int  $payerId
     * @param  string  $title
     * @param  string  $price
     * @param  string  $memo
     */
    public function __construct(
        int $eventId,
        int $payerId,
        string $title,
        string $price,
        string $memo
    )
    {
        $this->eventId = $eventId;
        $this->payerId = $payerId;
        $this->title = $title;
        $this->price = $price;
        $this->memo = $memo;
    }

    /**
     * 保存用の配列に変換する
     * @return array
     */
    public function toArray(): array
    {
        return [
            'event_id' => $this->eventId,
            'payer_id' => $this->payerId,
            'title' => $this->title,
            'price' => $this->price,
            'memo' => $this->memo
        ];
    }
}
