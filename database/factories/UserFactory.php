<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startTimestamp = strtotime('2024-08-11');
        $endTimestamp = time();
        $randomTimestamp = rand($startTimestamp, $endTimestamp);

        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'user_name' => null,
            'gender' => null,
            'dob' => null,
            'address' => null,
            // 'address' => $this->faker->sentence(),
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            // 'phone' => $this->faker->numberBetween(7000000000,9999999999),
            'phone' => null,
            // 'about' => $this->faker->text(1000),
            'about' => null,
            'portfolio_url' => null,
            'profile_picture' => null,
            'marital_status' => null,
            'qualification' => null,
            'occupation' => null,
            'added_time' => new UTCDateTime($randomTimestamp*1000),
            'last_updated_time' => null,
            'status' => '1'
        ];
    }
}
