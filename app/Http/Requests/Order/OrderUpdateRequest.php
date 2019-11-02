<?php

namespace App\Http\Requests\Order;

class OrderUpdateRequest extends BaseRequest
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
            'guest_name'        => ['required', 'string', 'max:255',],
            'passport_series'   => ['required', 'string', 'size:4',],
            'passport_number'   => ['required', 'string', 'size:6',],
            'phone_number'      => ['required', 'string', 'max:12',],
            'hotel_name'        => ['required', 'string', 'max:255',],
            'room_type'         => ['required', 'string', 'max:255',],
            'amenities'         => ['sometimes', 'array',],
            'date_of_arrival'   => ['required', 'before_or_equal:date_of_departure'],
            'date_of_departure' => ['required', 'after_or_equal:date_of_arrival'],
            'percent_discounts' => ['nullable', 'integer'],
            'amount_discounts'  => ['nullable', 'numeric'],
            'total_cost'        => ['required', 'numeric'],
        ];
    }
}
