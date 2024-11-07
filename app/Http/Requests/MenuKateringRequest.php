<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuKateringRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    private String $response = '';

    public function prepValidation()
    {
        $this->response = $this->route('id') === 0 ? 'required' : 'nullable';
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => $this->response.'|string|max:255',
            'category_id' => $this->response.'|numeric',
            'deskripsi' => $this->response.'|string',
            'harga' => $this->response.'|numeric',
            'gambar' => 'nullable',
            'qty' => $this->response.'|numeric|max:255'
        ];
    }
}
