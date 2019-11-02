<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoomsSettingsRequest extends FormRequest
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
    public function rules($action, $id)
    {
        session()->flash('rooms', true);
        if ($action == 'create') {
            return [
                'element_name' => ['required', 'string', 'max:255',
                    Rule::unique('settings')->whereIn('deleted_at', [null]),],
                'value'        => ['required', 'numeric','min:0'],
            ];
        } elseif ($action == 'edit') {
            return [
                'element_name' => ['required', 'string', 'max:255',
                    Rule::unique('settings')->ignore($id, 'id')->whereIn('deleted_at', [null]),],
                'value'        => ['required', 'numeric','min:0'],
            ];
        }
    }
}
