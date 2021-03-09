<?php


namespace Tests\Feature\Repository;


use App\Entities\CharacterEntity;
use App\Exceptions\InvalidGenderException;
use App\Models\Character;
use App\Models\Title;
use App\Repository\CharacterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CharacterRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @var CharacterRepository
     */
    private $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = app(CharacterRepository::class);
    }

    /**
     * @test
     */
    public function insertFromApiInvalidGenderExceptionIsThrown(): void
    {
        $this->expectException(InvalidGenderException::class);
        $this->repository->insertFromApi(new CharacterEntity('', '', 'invalid gender', '', '', '', []));
    }

    /**
     * @test
     */
    public function insertFromApiSuccessOnEmptyData(): void
    {
        $this->assertInstanceOf(
            Character::class,
            $this->repository->insertFromApi(
                new CharacterEntity('', '', Character::MALE, '', '', '', [])
            )
        );
    }

    /**
     * @test
     */
    public function attachTitleSuccessfulTitleAttach(): void
    {
        $title = 'title name';
        $character = Character::factory()->create();
        Title::factory()->create();

        $this->assertTrue($this->repository->attachTitle($character, [$title]));
        $this->assertNotEmpty(Title::where('name', $title)->get()->toArray());
        $this->assertNotEmpty($character->titles->toArray());
    }

}
