<?php

namespace App\Repositories\Eloquent;

use App\Models\Setting;
use App\Repositories\SettingRepositoryInterface;
use Illuminate\Support\Collection;

class SettingRepository extends BaseRepository implements SettingRepositoryInterface
{

     /**
     * @var Model
     */
    protected $model;

   /**
    * SettingRepository constructor.
    *
    * @param Setting $model
    */
   public function __construct(Setting $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all(): Collection
   {
       return $this->model->all();
   }

     /**
     * Add a settings value
     *
     * @param $key
     * @param $val
     * @param string $type
     * @return bool
     */
    public function addSetting($data)
    {
        $rules = $this->model->getValidationRules();
        $validSettings = array_keys($rules);

        foreach ($data as $key => $val) {
            if (in_array($key, $validSettings)) {
                if ($key !== 'logo' && $key !== 'logo_footer' && $key !== 'thumbnail' && $key !== 'noimage') {
                    $this->model->add($key, $val, $this->model->getDataType($key));
                } else {
                    $val = $this->copyFile($val);
                    $this->model->add($key, $val, $this->model->getDataType($key));
                }

            }
        }
        return true;
    }
    /**
     * array
     *
     * @return array
     */
    public function getValidation(): array {
        return $this->model->getValidationRules();
    }

    /**
     * return key not in request
     * @param array $request
     * @return array
     */
    public function validateSetting($request): array {
        $input =  $request->all();
        $rules = $this->getValidation();
        return array_filter(
            $rules,
            function($key) use ($input) {
            if (array_key_exists($key, $input)) {
                return $key;
            }
        },
        ARRAY_FILTER_USE_KEY
    );
    }
}
