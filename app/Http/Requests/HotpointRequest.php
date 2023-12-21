<?php

namespace App\Http\Requests;

use App\Rules\HotpointPositionX;
use App\Rules\HotpointPositionY;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HotpointRequest extends FormRequest
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
        $hotpointId = optional($this->hotpoint)->id;

        return [
            'name' => [
                'required',
                'max:255',
                Rule::unique('hotpoints', 'name')->ignore($hotpointId)
            ],
            'position_x' => [
                'required',
                'numeric',
                'between:0,4000',
                new HotpointPositionX($hotpointId)
            ],
            'position_y' => [
                'required',
                'numeric',
                'between:0,4000',
                new HotpointPositionY($hotpointId)
            ],
            'product_id' => [
                'required',
                'numeric',
                'exists:products,id'
            ],
            'activity' => [
                'required',
                'numeric',
                'min:1',
                'max:99999'
            ],
        ];
    }
}
