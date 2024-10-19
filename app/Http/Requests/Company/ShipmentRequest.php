<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class ShipmentRequest extends FormRequest
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
        return [
            'products'       => 'required',
            'quantity'       => 'nullable',
            "street"         => "required",
            "phone"          => 'nullable',
            "additional"     => "nullable",
            "post_code"      => "required |numeric",
            "city"           => "required",
            "state"          => "nullable",
            "country_id"     => "required",
            "address_id"     => "nullable",
            "company_name"   => "nullable",
            "company_email"  => "nullable",
            "company_number" => "nullable",
            "type"           => "required",
            "warehouse_id"   => "required",
            "order_number"   => "nullable|unique:shipments,order_number," . $this->shipment,
            "invoice_number" => "nullable|unique:shipments,invoice_number," . $this->shipment,
            "type_of_good"   => "nullable",
            "note"           => 'nullable',
            'status'         => 'nullable',
        ];
    }
}
