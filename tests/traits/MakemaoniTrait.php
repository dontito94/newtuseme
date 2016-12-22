<?php

use Faker\Factory as Faker;
use App\Models\maoni;
use App\Repositories\maoniRepository;

trait MakemaoniTrait
{
    /**
     * Create fake instance of maoni and save it in database
     *
     * @param array $maoniFields
     * @return maoni
     */
    public function makemaoni($maoniFields = [])
    {
        /** @var maoniRepository $maoniRepo */
        $maoniRepo = App::make(maoniRepository::class);
        $theme = $this->fakemaoniData($maoniFields);
        return $maoniRepo->create($theme);
    }

    /**
     * Get fake instance of maoni
     *
     * @param array $maoniFields
     * @return maoni
     */
    public function fakemaoni($maoniFields = [])
    {
        return new maoni($this->fakemaoniData($maoniFields));
    }

    /**
     * Get fake data of maoni
     *
     * @param array $postFields
     * @return array
     */
    public function fakemaoniData($maoniFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'catergory' => $fake->word,
            'title' => $fake->word,
            'target' => $fake->word,
            'discription' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $maoniFields);
    }
}
