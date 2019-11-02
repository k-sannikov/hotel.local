<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsersSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules($action, $id)
    {
        session()->flash('users', true);
        if ($action == 'create') {
            return [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'role' => ['required', 'string'],
            ];
        } elseif ($action == 'edit') {
            return array_merge(parent::rules(), [
                'email' => [Rule::unique('users')->ignore((isset($id) ? $id : "0"), 'id')],
                'password' => ['nullable'],
                'role' => ['string'],
            ]);
        }

    }
}
