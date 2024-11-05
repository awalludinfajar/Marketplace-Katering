<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuKateringRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'category_id' => 'required|numeric',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'qty' => 'required|numeric|max:255'
        ];
    }
}
