<?php

namespace App\Http\Requests\Work;

use Illuminate\Foundation\Http\FormRequest;

class WorkListRequest extends FormRequest
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
                    'title' => 'required',
                    'department_id' => 'required',
                    'start_at' => 'required',
                    'end_at' => 'required',
                ];
                break;
            case 'PUT':
                return [
                    'title' => 'required',
                    'department_id' => 'required',
                    'start_at' => 'required',
                    'end_at' => 'required',
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
