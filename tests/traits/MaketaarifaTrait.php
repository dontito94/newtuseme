<?php

use Faker\Factory as Faker;
use App\Models\taarifa;
use App\Repositories\taarifaRepository;

trait MaketaarifaTrait
{
    /**
     * Create fake instance of taarifa and save it in database
     *
     * @param array $taarifaFields
     * @return taarifa
     */
    public function maketaarifa($taarifaFields = [])
    {
        /** @var taarifaRepository $taarifaRepo */
        $taarifaRepo = App::make(taarifaRepository::class);
        $theme = $this->faketaarifaData($taarifaFields);
        return $taarifaRepo->create($theme);
    }

    /**
     * Get fake instance of taarifa
     *
     * @param array $taarifaFields
     * @return taarifa
     */
    public function faketaarifa($taarifaFields = [])
    {
        return new taarifa($this->faketaarifaData($taarifaFields));
    }

    /**
     * Get fake data of taarifa
     *
     * @param array $postFields
     * @return array
     */
    public function faketaarifaData($taarifaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'position' => $fake->word,
            'heading' => $fake->word,
            'discription' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $taarifaFields);
    }
}
