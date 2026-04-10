<?php
namespace App\Repositories;

use App\Models\Setting;
use Illuminate\Support\Collection;

interface SettingRepositoryInterface
{
   public function all(): Collection;
}
