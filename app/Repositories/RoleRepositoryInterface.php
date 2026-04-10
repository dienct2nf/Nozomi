<?php
namespace App\Repositories;

use Illuminate\Support\Collection;

interface RoleRepositoryInterface
{
   public function all(): Collection;
}
