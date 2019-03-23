<?php

use App\Interfaces\ITimeClock;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class ClockTypeSeeder
 */
class ClockTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getClockTypesData() as $clockTypesData) {
            DB::table('clock_types')->insert([
                'name' => $clockTypesData['name'],
                'description' => $clockTypesData['description'],
            ]);
        }
    }

    /**
     * @return array
     */
    private function getClockTypesData()
    {
        return [
            [
                'name' => ITimeClock::TYPE_WORKING,
                'description' => 'Horario laboral',
            ],
            [
                'name' => ITimeClock::TYPE_LUNCH,
                'description' => 'Hora de comida',
            ],
            [
                'name' => ITimeClock::TYPE_BREAK,
                'description' => 'Descanso',
            ],
        ];
    }
}
