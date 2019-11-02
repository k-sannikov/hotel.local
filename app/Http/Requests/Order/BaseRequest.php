<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BaseRequest extends FormRequest
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
        if (isset(Request::all()['button'])) {
            switch (Request::all()['button']) {
                case 'booking-create':
                    $orderStoreRequest = new OrderStoreRequest();
                    return $orderStoreRequest->rules();
                    break;

                case 'booking-update':
                    $orderUpdateRequest = new OrderUpdateRequest();
                    return $orderUpdateRequest->rules();
                    break;

                case 'calculation':
                    $calculationRequest = new CalculationRequest();
                    return $calculationRequest->rules();
                    break;

                default:
                    back();
                    break;
            }
        }

        return [
            //
        ];
    }
}
