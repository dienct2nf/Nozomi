<?php
namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

/**
* Interface EloquentRepositoryInterface
* @package App\Repositories
*/
interface EloquentRepositoryInterface
{

   /**
    * @return Model
    */
   public function all();
   /**
    * @param array $attributes
    * @return Model
    */
   public function create(array $attributes): ?Model;

   /**
    * @param array $data
    * @param int $id
    * @return Model
    */
   public function update(array $data, $id): ?bool;

   /**
    * @param int $id
    * @return Model
    */
   public function delete($id): ? bool;

   /**
    * @param int $id
    * @return Model
    */
   public function show($id): ? Model;

   /**
    * @param int $id
    * @return Model
    */
   public function find($id): ?Model;

   /**
    * @param string $text
    * @return String
    */
    public function slug($text): ?string;
}
