<?php
namespace App\Repositories;

use App\Models\Slider;
use Illuminate\Support\Collection;

interface SliderRepositoryInterface
{
   public function all(): Collection;
}
