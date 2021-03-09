<?php


namespace App\Repository;


use App\Models\Title;

class TitleRepository
{

    /**
     * @param string $title
     * @return Title
     */
    public function firstOrCreate(string $title): Title
    {
        return Title::firstOrCreate(['name' => $title]);
    }

}
