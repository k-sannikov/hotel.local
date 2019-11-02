<?php

namespace App\Http\Requests\Settings;

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
            $button = Request::all()['button'];
            $id = $this::route('setting');

            switch (Request::all()['button']) {
                case 'rooms':
                    $roomsSettingsRequest = new RoomsSettingsRequest();
                    return $roomsSettingsRequest->rules(Request::all()['action'], $id);
                    break;

                case 'amenities':
                    $amenitiesSettingsRequest = new AmenitiesSettingsRequest();
                    return $amenitiesSettingsRequest->rules(Request::all()['action'], $id);
                    break;

                case 'hotels':
                    $hotelsSettingsRequest = new HotelsSettingsRequest();
                    return $hotelsSettingsRequest->rules(Request::all()['action'], $id);
                    break;

                case 'min':
                    $discountSettingsRequest = new DiscountSettingsRequest();
                    return $discountSettingsRequest->rules($button, Request::all()['value']);
                    break;

                case 'max':
                    $discountSettingsRequest = new DiscountSettingsRequest();
                    return $discountSettingsRequest->rules($button, Request::all()['value']);
                    break;

                case 'users':
                    $usersSettingsRequest = new UsersSettingsRequest();
                    return $usersSettingsRequest->rules(Request::all()['action'], $id);
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
