<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Settings;

class DiscountSettingsRequest extends FormRequest
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
    public function rules($type, $value)
    {
        session()->flash('discount', true);
        $settingsAll = collect(Settings::toBase()->get());

        $max = $settingsAll
            ->where('group_name', 'discount')
            ->where('element_name', 'max')
            ->first()
            ->value;
        $min = $settingsAll
            ->where('group_name', 'discount')
            ->where('element_name', 'min')
            ->first()
            ->value;

        if ($type == 'max') {
            return [
                'group_name'   => ['required',],
                'element_name' => ['required', 'string', 'size:3'],
                'value'        => ['required', 'numeric', "min:$min", 'max:100',],
            ];
        } elseif ($type == 'min') {
            return [
                'group_name'   => ['required',],
                'element_name' => ['required', 'string', 'size:3'],
                'value'        => ['required', 'numeric','min:0', "max:$max",],
            ];
        }
    }
}
