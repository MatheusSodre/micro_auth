<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $uuid = $this->user;
        return [
            'name'        => ['required', 'string', 'min:3', 'max:100'],
            'password'    => ['required', 'min:4', 'max:16'],
            'email'       => ['required', 'email', 'max:255',"unique:users,email"],
            'device_name' => ['required', 'string', 'max:200'],
        ];
    }
}
