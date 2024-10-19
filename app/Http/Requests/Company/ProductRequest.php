<?php

namespace App\Http\Requests\Company;

use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        Session::put('active_tab', 'product');
        return [
            'name' => 'required|unique:products,name,' . $this->product,
            'sku' => 'required|unique:products,sku,' . $this->product,
            'type' => 'nullable',
            'prepacked' => 'nullable',
            'weight' => 'required|string',
            'barcode_type' => 'nullable|string',
            'barcode_number' => 'nullable|string|unique:packaging_materials,sku,' . $this->product,
            'description' => 'nullable|string',
            'tariff_number' => 'nullable|string',
            'country_id' => 'required|string',
            'pre_length' => 'nullable',
            'pre_width' => 'nullable',
            'pre_height' => 'nullable',
            'status' => 'nullable',
        ];
    }
}
