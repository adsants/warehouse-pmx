<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionWarehouseInRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sparepart_id' => 'required|integer',
            'location_id' => 'required|integer',
            'qty' => 'required|integer|max:99999',
            'entry_date' => 'required|date_format:Y-m-d',
        ];
    }
}