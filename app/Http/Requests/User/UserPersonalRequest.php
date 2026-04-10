<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserPersonalRequest extends FormRequest
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
        $check = $this->route()->parameters();
        $id = !empty($check)?$this->route()->parameters()['user']:'';
        switch($this->method())
        {
            case 'GET':
            break;
            case 'DELETE':
                return [];
                break;
            case 'POST':
                return [];
                break;
            case 'PUT':
                return [
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'job_id' => 'required',
                    'phone' => 'nullable|unique:users,phone, '.auth()->user()->id,
                    'email' => 'nullable|unique:users,email, '.auth()->user()->id,
                    'password' => 'same:confirm-password',
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
