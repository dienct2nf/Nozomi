<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        switch($this->method())
        {
            case 'GET':
            break;
            case 'DELETE':
                return [];
                break;
            case 'POST':
                return [
                    'phone' => 'required',
                    'full_name' => 'required',
                    'birth_day' => 'required',
                    'address' => 'required',
                ];
                break;
            case 'PUT':
                return [
                    'phone' => 'required',
                    'full_name' => 'required|max:255',
                    'birth_day' => 'required',
                    'address' => 'required',
                    'sex' => 'required',
                    'product_id' => 'required|notIn:0',
                ];
                break;
            case 'PATCH':
                return [];
                break;
            default:
            break;
        }
    }
}
