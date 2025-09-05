<?php

namespace App\Repositories;

use App\Models\Area;
use Illuminate\Support\Str;

class AuthRepository
{

    protected $area;

    public function __construct(Area $area)
    {
        $this->area = $area;
    }

    public function login($request)
    {
        
    }

}