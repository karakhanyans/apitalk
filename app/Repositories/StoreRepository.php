<?php

namespace App\Repositories;

use App\Models\Store;

class StoreRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(new Store());
    }
}
