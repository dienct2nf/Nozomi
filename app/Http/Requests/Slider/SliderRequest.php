<?php

namespace App\Http\Requests\Slider;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
        $id = !empty($check)? $this->route()->parameters()['slider']:'';

        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                $newArrayAtribute = [];
                foreach (config('translatable.language') as $key => $item) {
                    if ($item['validated'] == true) {
                        $value = [
                            'title_'.$key => 'required|unique:slider_translations,title|max:255',
                            'description_'.$key => 'required|max:380',
                        ];
                        $newArrayAtribute = array_merge($newArrayAtribute, $value);
                    }
                }
                $newArrayAtribute = array_merge($newArrayAtribute, ['image' => 'required']);
                $newArrayAtribute = array_merge($newArrayAtribute, ['link' => 'required']);
                $newArrayAtribute = array_merge($newArrayAtribute, ['order' => 'required']);
                return $newArrayAtribute;
            }
            case 'PUT':
            case 'PATCH':
            {
                $newArrayAtribute = [];
                foreach (config('translatable.language') as $key => $item) {
                    if ($item['validated'] == true) {
                        $value = [
                            'title_'.$key => 'required|unique:slider_translations,title, '.$id.'|max:255',
                            'description_'.$key => 'required|max:380',
                        ];
                        $newArrayAtribute = array_merge($newArrayAtribute, $value);
                    }
                }
                $newArrayAtribute = array_merge($newArrayAtribute, ['link' => 'required']);
                $newArrayAtribute = array_merge($newArrayAtribute, ['order' => 'required']);
                return $newArrayAtribute;
            }
            default:
        break;
        }
    }
}
