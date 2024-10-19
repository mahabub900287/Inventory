<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $commonRules = [
            'delivery_type' => 'required',
            'product_type' => ['required', 'in:0,1'],
            'warehouse_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'inbound' => 'nullable',
            'sender_name' => 'nullable',
            'sender_address' => 'nullable',
            'description' => 'nullable',
            'ref_number' => 'nullable',
        ];

        if ($this->uploaded_file) {
            return array_merge($commonRules, [
                'product_id' => 'nullable|array',
                'product_qty' => 'nullable|array',
                'product_tracking' => 'nullable|array',
                'parcel_qty' => 'required|array',
                'parcel_tracking' => 'required|array',
                'uploaded_file' => 'required|mimes:csv',
            ]);
        } else {
            return array_merge($commonRules, [
                'product_id' => 'required|array',
                'product_qty' => 'required|array',
                'product_tracking' => 'required|array',
                'parcel_qty' => 'required|array',
                'parcel_tracking' => 'required|array',
                'uploaded_file' => 'nullable|mimes:csv',
            ]);
        }
    }
}
