<?php


namespace App\Http\Services\Frontend\Payment;


use App\Http\Repositories\Payment\Params\PaymentParams;
use App\Models\Payment;
use Illuminate\Support\Collection;

interface PaymentServiceContract
{
    /**
     * イベントの支払いをすべて取得する
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
     * 支払いを取得する
     * @param  int  $paymentId
     * @return Payment
     */
    public function findPayment(int $paymentId): Payment;

    /**
     * 支払いを更新する
     * @param  Payment  $payment
     * @param  PaymentParams  $params
     */
    public function updatePayment(Payment $payment, PaymentParams $params): void;

    /**
     * 支払いを削除する
     * @param  int  $paymentId
     */
    public function deletePayment(int $paymentId): void;
}
