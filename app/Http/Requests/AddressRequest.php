<?php

namespace App\Http\Requests;

use App\Rules\AddressUnique;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AddressRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {
        $userId = $request->user()->id;
        $tableName = 'users_address';
        
        return [
            'typeAddress' => 'required|string',
            'address' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'postCode' => 'required|numeric',
            'mainAddress' => ['nullable','boolean',new AddressUnique($userId, $tableName, 'primary', $this->route('id'))]
        ];
    }
}
