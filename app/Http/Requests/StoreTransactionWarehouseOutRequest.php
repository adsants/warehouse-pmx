<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionWarehouseOutRequest extends FormRequest
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
            'from_location_id' => 'required|integer',
            'to_location_id' => 'integer',
            'entry_date' => 'required|date_format:Y-m-d',
            'qty' => 'required|integer|max:99999'
        ];
    }
}