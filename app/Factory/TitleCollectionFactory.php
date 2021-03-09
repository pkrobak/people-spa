<?php


namespace App\Factory;


use App\Repository\TitleRepository;
use Illuminate\Support\Collection;

class TitleCollectionFactory
{
    private $titleRepository;

    /**
     * TitleCollectionFactory constructor.
     * @param $titleRepository
     */
    public function __construct(TitleRepository $titleRepository)
    {
        $this->titleRepository = $titleRepository;
    }

    /**
     * @param array $titles
     * @return Collection
     */
    public function create(array $titles): Collection
    {
        $collection = new Collection();
        foreach ($titles as $title) {
            $collection->push($this->titleRepository->firstOrCreate($title));
        }

        return $collection;
    }
}
