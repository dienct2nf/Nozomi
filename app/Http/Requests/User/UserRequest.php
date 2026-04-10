<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                return [
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'roles' => 'required',
                    'job_id' => 'required',
                    'email' => 'required|unique:users,email',
                    'phone' => 'nullable|unique:users,phone',
                    'password' => 'required|same:confirm-password',
                    // 'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];
                break;
            case 'PUT':
                return [
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'roles' => 'required',
                    'job_id' => 'required',
                    'phone' => 'nullable|unique:users,phone,'.$this->route('user'),
                    'email' => 'nullable|unique:users,email,'.$this->route('user'),
                    'password' => 'same:confirm-password',
                    'roles' => 'required'
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
