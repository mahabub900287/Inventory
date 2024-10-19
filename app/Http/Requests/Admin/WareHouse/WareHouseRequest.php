<?php

namespace App\Http\Requests\Admin\WareHouse;

use Illuminate\Foundation\Http\FormRequest;

class WareHouseRequest extends FormRequest
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
            'name'       => ['required', 'string', 'max: 100', 'unique:ware_houses,name,' . $this->ware_house],
            'user_id'    => ['required'],
            'country_id' => ['required'],
            'email'      => ['required', 'email'],
            'phone'      => ['nullable', 'string', 'max: 25', 'regex  : /^[0-9\-\+]+$/', 'unique:users,phone'],
            "street"     => ["required"],
            "additional" => ["nullable"],
            "post_code"  => ["required", "numeric"],
            "city"       => ["required"],
            "state"      => ["nullable"],
            'status'     => ['nullable']
        ];
    }
}
