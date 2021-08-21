<?php


namespace App\ViewModels\Frontend;


use App\Models\Payment;
use App\ViewModels\Base\ViewModel;
use Illuminate\Support\Collection;

class PaymentViewModel extends ViewModel
{
    private Payment $payment;

    /**
     * PaymentViewModel constructor.
     * @param  Payment  $payment
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * @param  Collection|Payment[]  $payments
     * @return Collection|PaymentViewModel[]
     */
    public static function collect(Collection $payments): Collection
    {
        return $payments->map(fn ($payment) => new self($payment));
    }

    /**
     * @inheritDoc
     */
    public function toMap(): array
    {
        return [
            'id' => $this->payment->id,
            'event_id' => $this->payment->event_id,
            'payer_id' => $this->payment->payer_id,
            'title' => $this->payment->title,
            'price' => $this->payment->price,
            'memo' => $this->payment->memo
        ];
    }
}
