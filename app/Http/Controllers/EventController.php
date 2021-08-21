<?php

namespace App\Http\Controllers;

use App\Http\Requests\Frontend\Event\EventRequest;
use App\Http\Services\Frontend\Event\EventServiceContract;
use App\Http\Services\Frontend\Payment\PaymentServiceContract;
use App\ViewModels\Frontend\EventViewModel;
use Illuminate\Http\JsonResponse;

/**
 * イベント
 * Class EventController
 * @package App\Http\Controllers
 */
class EventController extends Controller
{
    private EventServiceContract $eventService;
    private PaymentServiceContract $paymentService;

    /**
     * EventController constructor.
     * @param  EventServiceContract  $eventService
     * @param  PaymentServiceContract  $paymentService
     */
    public function __construct(
        EventServiceContract $eventService,
        PaymentServiceContract $paymentService
    )
    {
        $this->eventService = $eventService;
        $this->paymentService = $paymentService;
    }

    /**
     * イベント一覧を返すAPI
     */
    public function index(): JsonResponse
    {
        $events = $this->eventService->fetchAllEvents();

        return response()->json(
            EventViewModel::collect($events),
        );
    }

    /**
     * イベント詳細を取得する
     * @param  int  $eventId
     * @return JsonResponse
     */
    public function show(int $eventId): JsonResponse
    {
        $event = $this->eventService->findEvent($eventId);
        $payments = $this->paymentService->fetchPaymentsByEventId($eventId);
        $total = $payments->sum('price');

        $total1 = $payments->where('payer_id', 1)->sum('price');
        $total2 = $payments->where('payer_id', 2)->sum('price');

        $average = floor($total / 2);

        $difference1 = $average - $total1;
        $difference2 = $average - $total2;


        return response()->json([
            'event' => [
                'id' => $event->id,
                'title' => $event->title,
                'total' => '¥' . number_format($total),
            ],
            'users' => [
                '1' => [
                    'total' => '¥' . number_format($total1),
                    'difference' => '¥' . number_format(abs($difference1)),
                    'sign' => $difference1 > 0,
                ],
                '2' => [
                    'total' => '¥' . number_format($total2),
                    'difference' => '¥' . number_format(abs($difference2)),
                    'sign' => $difference2 > 0,
                ],
            ],
            'settlement' => $event->settlement
        ]);
    }

    /**
     * イベントを登録する
     * @param  EventRequest  $request
     * @return JsonResponse
     */
    public function store(EventRequest $request): JsonResponse
    {
        $this->eventService->storeEvent($request->getEventParams());
        $events = $this->eventService->fetchAllEvents();

        return response()->json(
            EventViewModel::collect($events),
        );
    }

    /**
     * イベントを更新する
     * @param  int  $eventId
     * @param  EventRequest  $request
     * @return JsonResponse
     */
    public function update(int $eventId, EventRequest $request): JsonResponse
    {
        $event = $this->eventService->findEvent($eventId);
        $this->eventService->updateEvent($event, $request->getEventParams());
        $events = $this->eventService->fetchAllEvents();

        return response()->json(
            EventViewModel::collect($events),
        );
    }

    /**
     * イベントを削除する
     * @param  int  $eventId
     * @return JsonResponse
     */
    public function destroy(int $eventId): JsonResponse
    {
        $this->eventService->deleteEvent($eventId);
        $events = $this->eventService->fetchAllEvents();

        return response()->json(
            EventViewModel::collect($events),
        );
    }
}
