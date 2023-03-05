<?php

namespace App\Http\Requests;
use App\Traits\FormRequestValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class CityValidationRequest extends FormRequest
{

    use FormRequestValidationTrait;
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
            'state_uuid'  => 'required|exists:states,uuid',
            'name'  => 'required|unique:cities,name'
        ];
    }
}
