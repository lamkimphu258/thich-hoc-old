<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use Database\Seeders\Traits\HasTruncate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class AnswerSeeder extends Seeder
{
    use HasTruncate;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->truncate('answers');

        $this->call([
            QuestionSeeder::class,
        ]);

        $numberOfAnswers = [2, 3];
        Question::all()->each(function ($question) use ($numberOfAnswers) {
            Answer::factory()
                ->count(Arr::random($numberOfAnswers))
                ->create([
                    'question_id' => $question->id,
                ]);
            Answer::factory()
                ->markCorrect()
                ->create([
                    'question_id' => $question->id,
                ]);
        });
    }
}
