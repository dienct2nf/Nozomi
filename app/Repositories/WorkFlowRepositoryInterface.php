<?php
namespace App\Repositories;
use Illuminate\Support\Collection;

interface WorkFlowRepositoryInterface
{
   public function all(): Collection;
}
