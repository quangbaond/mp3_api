<?php

namespace App\Repositories\Eloquent;

use App\Models\Mission;

class MissionRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Mission::class;
    }

}
