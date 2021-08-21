<?php

namespace App\Http\Controllers;

use App\Http\Requests\Payment\PaymentRequest;
use App\Http\Services\Frontend\Payment\PaymentServiceContract;
use App\ViewModels\Frontend\PaymentViewModel;
use Illuminate\Http\JsonResponse;
use Psy\Util\Json;

/**
 * 支払い
 * Class PaymentController
 * @package App\Http\Controllers
 */
class PaymentController extends Controller
{
    private PaymentServiceContract $paymentService;

    /**
     * PaymentController constructor.
     * @param  PaymentServiceContract  $paymentService
     */
    public function __construct(PaymentServiceContract $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * 支払いの一覧を取得する
     * @param  int  $eventId
     * @return JsonResponse
     */
    public function index(int $eventId): JsonResponse
    {
        $payments = $this->paymentService->fetchPaymentsByEventId($eventId);

        return response()->json(PaymentViewModel::collect($payments));
    }

    /**
     * 支払いを登録する
     * @param  int  $eventId
     * @param  PaymentRequest  $request
     * @return JsonResponse
     */
    public function store(int $eventId, PaymentRequest $request): JsonResponse
    {
        $this->paymentService->storePayment($request->getPaymentParams());

        return response()->json();
    }

    /**
     * 支払いを更新する
     * @param  int  $eventId
     * @param  int  $paymentId
     * @param  PaymentRequest  $request
     * @return JsonResponse
     */
    public function update(int $eventId, int $paymentId, PaymentRequest $request):JsonResponse
    {
        $payment = $this->paymentService->findPayment($paymentId);
        $this->paymentService->updatePayment($payment, $request->getPaymentParams());

        return response()->json(['event_id' => $eventId]);
    }

    /**
     * 支払いを削除する
     * @param  int  $eventId
     * @param  int  $paymentId
     * @return JsonResponse
     */
    public function destroy(int $eventId, int $paymentId):JsonResponse
    {
        $this->paymentService->deletePayment($paymentId);

        return response()->json();
    }
}
