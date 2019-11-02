<?php

namespace App\Http\Requests\Order;

use Carbon\Carbon;
use Illuminate\Http\Request;

class CalculationRequest extends BaseRequest
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
            'room_type'         => ['required', 'string', 'max:255',],
            'amenities'         => ['sometimes', 'array',],
            'date_of_arrival'   => ['required', 'before_or_equal:date_of_departure'],
            'date_of_departure' => ['required', 'after_or_equal:date_of_arrival'],
            'percent_discounts' => ['nullable', 'integer'],
        ];
    }
}
