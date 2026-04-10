<?php

namespace App\Http\Requests\Product;

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
                    'name' => 'required|unique:products',
                    'description' => 'required|max:255',
                    'slot' => 'required|max:11',
                    'workplace' => 'required',
                    'content' => 'required',
                    'price' => 'required',
                    'date' => 'required',
                    'status' => 'required',
                ];
                break;
            case 'PUT':
                return [
                    'name' => 'required|unique:products,name,' . $this->route('product'),
                    'description' => 'required|max:255',
                    'slot' => 'required|max:11',
                    'workplace' => 'required',
                    'content' => 'required',
                    'price' => 'required',
                    'date' => 'required',
                    'status' => 'required',
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
