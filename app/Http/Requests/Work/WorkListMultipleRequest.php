<?php

namespace App\Http\Requests\Work;

use Illuminate\Foundation\Http\FormRequest;

class WorkListMultipleRequest extends FormRequest
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
                    'row.*.title' => 'required',
                    'row.*.department_id' => 'required',
                    'row.*.start_at' => 'required',
                    'row.*.end_at' => 'required',
                ];
                break;
            case 'PUT':
                return [
                    'row.*.title' => 'required',
                    'row.*.department_id' => 'required',
                    'row.*.start_at' => 'required',
                    'row.*.end_at' => 'required',
                ];
                break;
            case 'PATCH':
                return [];
                break;
            default:
            break;
        }
    }

    public function messages()
    {
        return [
            'row.*.title.required' => 'Tên công việc không được để trống',
            'row.*.department_id.required' => 'Phòng ban không được để trống',
            'row.*.start_at.required' => 'Ngày bắt đầu không được để trống',
            'row.*.end_at.required' => 'Ngày kết thúc không được để trống'
        ];
    }
}
