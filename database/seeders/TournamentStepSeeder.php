<?php

namespace Database\Seeders;

use App\Models\TournamentStep;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TournamentStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(TournamentStep::all()->count() == 0){
            //1
            TournamentStep::create([
                'title_ru' => 'Игра на выбивание',
                'title_kk' => 'Нокаут ойыны',
                'title_en' => 'Elimination game',
                'max_participants' => 1000,
                'is_first' => true,
                'is_last' => false,
                'prev_id' => null,
                'next_id' => null,
                'order' => 1,
                'is_playoff' => false
            ]);
            //2
            TournamentStep::create([
                'title_ru' => '1/4',
                'title_kk' => '1/4',
                'title_en' => '1/4',
                'max_participants' => 8,
                'is_first' => false,
                'is_last' => false,
                'prev_id' => 1,
                'next_id' => null,
                'order' => 2,
                'is_playoff' => true
            ]);
            //3
            TournamentStep::create([
                'title_ru' => '1/2',
                'title_kk' => '1/2',
                'title_en' => '1/2',
                'max_participants' => 4,
                'is_first' => false,
                'is_last' => false,
                'prev_id' => 2,
                'next_id' => null,
                'order' => 3,
                'is_playoff' => true
            ]);
            //4
            TournamentStep::create([
                'title_ru' => 'Финал',
                'title_kk' => 'Финал',
                'title_en' => 'Final',
                'max_participants' => 2,
                'is_first' => false,
                'is_last' => true,
                'prev_id' => 3,
                'next_id' => null,
                'order' => 4,
                'is_playoff' => true
            ]);
            TournamentStep::find(1)->update(["next_id" => 2]);
            TournamentStep::find(2)->update(["next_id" => 3]);
            TournamentStep::find(3)->update(["next_id" => 4]);
        }

    }
}
