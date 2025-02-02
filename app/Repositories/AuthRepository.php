<?php

namespace App\Repositories;

use App\Models\User;

class AuthRepository extends BaseRepository
{
    /**
     * @param User $model
     */
    public function __construct(
        User $model
    ) {
        parent::__construct($model);
    }
}
