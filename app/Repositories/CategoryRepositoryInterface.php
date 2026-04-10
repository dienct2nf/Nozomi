<?php
namespace App\Repositories;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
   public function all(): Collection;

   public function attribute(array $request): Array;
}
