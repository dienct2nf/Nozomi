<?php

namespace App\Http\Requests\Album;

use Illuminate\Foundation\Http\FormRequest;

class AlbumRequest extends FormRequest
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
                    'name' => 'required|unique:albums',
                    'description' => 'required',
                    'content' => 'required',
                    'album' => 'required',
                ];
                break;
            case 'PUT':
                return [
                    'name' => 'required|unique:albums,name,' . $this->route('album'),
                    'description' => 'required',
                    'content' => 'required',
                    'album' => 'required',
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
