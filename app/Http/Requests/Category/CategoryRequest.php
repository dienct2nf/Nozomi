<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class CategoryRequest extends FormRequest
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
                            'title_'.$key => 'required|unique:category_translations,title|max:255',
                            'description_'.$key => 'required|max:380',
                            'title_seo_'.$key => 'required|max:255',
                            'description_seo_'.$key => 'required|max:380',
                        ];
                        $newArrayAtribute = array_merge($newArrayAtribute, $value);
                    }
                }
                // $newArrayAtribute = array_merge($newArrayAtribute, ['image' => 'required']);
                return $newArrayAtribute;
            }
            case 'PUT':
            case 'PATCH':
            {
                $newArrayAtribute = [];
                foreach (config('translatable.language') as $key => $item) {
                    if ($item['validated'] == true) {
                        $value = [
                            'title_'.$key => [
                                'required',
                                'max:255',
                                Rule::unique('category_translations', 'title')->where(function($query){
                                  $query->where('category_id', '<>', $this->route('category'));
                                })
                            ],
                            'description_'.$key => 'required|max:380',
                            'title_seo_'.$key => 'required|max:255',
                            'description_seo_'.$key => 'required|max:380',
                        ];
                        $newArrayAtribute = array_merge($newArrayAtribute, $value);
                    }
                }
                // $newArrayAtribute = array_merge($newArrayAtribute, ['image' => 'required']);
                return $newArrayAtribute;
            }
            default:break;
        }
    }
}
