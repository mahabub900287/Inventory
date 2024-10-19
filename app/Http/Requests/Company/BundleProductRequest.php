<?php

namespace App\Http\Requests\Company;

use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Http\FormRequest;

class BundleProductRequest extends FormRequest
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
        Session::put('active_tab', 'bundle');
        return [
            'name' => 'required|unique:bundles,name,' . $this->bundle_product,
            'sku' => 'required|unique:bundles,sku,' . $this->bundle_product,
            'products' => 'required',
            'quantity' => 'nullable',
            'tariff_number' => 'required|string',
            'country_id' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'nullable',
        ];
    }
}
