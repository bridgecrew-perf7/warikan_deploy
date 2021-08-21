<?php


namespace App\Http\Repositories\Payment;

use App\Http\Repositories\Payment\Params\PaymentParams;
use App\Models\Payment;
use Illuminate\Support\Collection;

/**
 * 支払い
 * Class PaymentRepository
 * @package App\Http\Repositories\Payment
 */
class PaymentRepository implements PaymentRepositoryContract
{

    /**
     * @inheritdoc
     */
    public function fetchPaymentsByEventId(int $eventId): Collection
    {
        return Payment::where('event_id', $eventId)
            ->orderByDesc('created_at')
            ->get();
    }

    /**
     * @inheritdoc
     */
    public function storePayment(PaymentParams $params): Payment
    {
        return Payment::create($params->toArray());
    }

    /**
     * @inheritdoc
     */
    public function findPayment(int $paymentId): Payment
    {
        return Payment::findOrFail($paymentId);
    }

    /**
     * @inheritdoc
     */
    public function updatePayment(Payment $payment, PaymentParams $params): void
    {
        $payment->update($params->toArray());
    }

    /**
     * @inheritdoc
     */
    public function deletePayment(int $paymentId): void
    {
        Payment::findOrFail($paymentId)->delete();
    }
}
