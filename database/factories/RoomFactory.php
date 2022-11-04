<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Room;
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model=Room::class;
    public function definition()
    {
        return [
            'name'=>$this->faker->word(),

        //     $table->bigIncrements('id');
        //     $table->bigInteger('user_id');
        //    $table->foreign('user_id')
        //      ->references('id')
        //      ->on('users')->onDelete('cascade');

        //    $table->timestamps();
        ];
    }
}
