<?php

namespace App\Http\Requests\Payment;

use App\Http\Repositories\Payment\Params\PaymentParams;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'price' => ['required', 'string', 'max:255'],
            'memo' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * 保存用のパラメータを取得する
     * @return PaymentParams
     */
    public function getPaymentParams(): PaymentParams
    {
        return new Paymentparams(
            $this->input('event_id'),
            $this->input('payer_id'),
            $this->input('title'),
            $this->input('price'),
            $this->input('memo')
        );
    }
}
