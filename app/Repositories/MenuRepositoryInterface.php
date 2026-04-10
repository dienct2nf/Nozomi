<?php
namespace App\Repositories;

use App\Models\Menu;
use Illuminate\Support\Collection;

interface MenuRepositoryInterface
{
   public function all(): Collection;
}
