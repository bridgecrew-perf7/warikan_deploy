<?php


namespace App\Http\Services\Frontend\Payment;


use App\Http\Repositories\Payment\Params\PaymentParams;
use App\Http\Repositories\Payment\PaymentRepositoryContract;
use App\Models\Payment;
use Illuminate\Support\Collection;

class PaymentService implements PaymentServiceContract
{
    private PaymentRepositoryContract $paymentRepository;

    /**
     * PaymentService constructor.
     * @param  PaymentRepositoryContract  $paymentRepository
     */
    public function __construct(PaymentRepositoryContract $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * @inheritdoc
     */
    public function fetchPaymentsByEventId(int $eventId): Collection
    {
        return $this->paymentRepository->fetchPaymentsByEventId($eventId);
    }

    /**
     * @inheritdoc
     */
    public function storePayment(PaymentParams $params): Payment
    {
        return $this->paymentRepository->storePayment($params);
    }

    /**
     * @inheritdoc
     */
    public function findPayment(int $paymentId): Payment
    {
        return $this->paymentRepository->findPayment($paymentId);
    }

    /**
     * @inheritdoc
     */
    public function updatePayment(Payment $payment, PaymentParams $params): void
    {
        $this->paymentRepository->updatePayment($payment, $params);
    }

    /**
     * @inheritdoc
     */
    public function deletePayment(int $paymentId): void
    {
        $this->paymentRepository->deletePayment($paymentId);
    }
}
