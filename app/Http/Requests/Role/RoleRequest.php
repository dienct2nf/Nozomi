<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        $id = !empty($check)?$this->route()->parameters()['role']:'';
        switch($this->method())
        {
            case 'GET':
            break;
            case 'DELETE':
                return [];
                break;
            case 'POST':
                return [
                    'name' => 'required|unique:roles',
                    'description' => 'required|max:255',
                    'permission' => 'required',
                ];
                break;
            case 'PUT':
                return [
                    'name' => 'required|unique:roles,name,' . $id,
                    'description' => 'required|max:255',
                    'permission' => 'required',
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
