<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class PackagingRequest extends FormRequest
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
            'name'           => 'required|unique:packaging_materials,name,' . $this->packaging,
            'sku'            => 'required|unique:packaging_materials,sku,' . $this->bundle_product,
            'type'           => 'required',
            'reorder_point'  => 'nullable',
            'description'    => 'nullable|string',
            'length'         => 'required|numeric|min  : 1|max: 1000',
            'width'          => 'required|numeric|min  : 1|max: 1000',
            'height'         => 'required|numeric|min  : 1|max: 1000',
            'status'         => 'nullable',
        ];
    }
}
