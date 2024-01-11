<?php

namespace App\Repositories\Eloquent;

class WithDrawRepository extends BaseRepository
{

    /**
     * @inheritDoc
     */
    public function model(): string
    {
        return \App\Models\WithDraw::class;
    }
}
