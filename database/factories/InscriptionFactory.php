<?php

namespace Database\Factories;

use App\Models\CostInscription;
use App\Models\Inscription;
use App\Models\School;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class InscriptionFactory extends Factory
{
    protected $model = Inscription::class;

    public function definition(): array
    {
        return [
            'number_paiment' => $this->faker->word(),
            'scolary_year_id' => $this->faker->randomNumber(),
            'user_id' => $this->faker->randomNumber(),
            'is_paied' => $this->faker->boolean(),
            'active' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'is_bank' => $this->faker->boolean(),
            'is_fonctionnement' => $this->faker->boolean(),
            'is_depense' => $this->faker->boolean(),
            'is_regularisation' => $this->faker->boolean(),
            'rate_id' => $this->faker->randomNumber(),
            'cost_inscription_id' => CostInscription::factory(),
            'student_id' => Student::factory(),
            'school_id' => School::factory(),
        ];
    }
}
