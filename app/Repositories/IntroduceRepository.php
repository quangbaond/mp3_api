<?php

namespace App\Repositories;

class IntroduceRepository extends Eloquent\BaseRepository
{

    /**
     * @inheritDoc
     */
    public function model(): string
    {
        return \App\Models\Introduce::class;
    }
}
