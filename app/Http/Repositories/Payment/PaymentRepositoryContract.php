<?php


namespace App\Http\Repositories\Payment;


use App\Http\Repositories\Payment\Params\PaymentParams;
use App\Models\Payment;
use Illuminate\Support\Collection;

/**
 * 支払い
 * Interface PaymentRepositoryContract
 * @package App\Http\Repositories\Payment
 */
interface PaymentRepositoryContract
{
    /**
     * IDで支払いを取得する
     * @param  int  $eventId
     * @return Collection|Payment[]
     */
    public function fetchPaymentsByEventId(int $eventId): Collection;

    /**
     * 支払いを登録する
     * @param  PaymentParams  $params
     * @return Payment
     */
    public function storePayment(PaymentParams $params): Payment;

    /**
     * IDで支払いを取得する
     * @param  int  $paymentId
     * @return Payment
     */
    public function findPayment(int $paymentId): Payment;

    /**
     * 支払いを更新する
     * @param  Payment  $payment
     * @param  PaymentParams  $params
     * @return void
     */
    public function updatePayment(Payment $payment, PaymentParams $params): void;

    /**
     * 支払いを削除する
     * @param  int  $paymentId
     */
    public function deletePayment(int $paymentId): void;
}
