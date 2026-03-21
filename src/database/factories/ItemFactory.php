<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\User;
use App\Models\Condition;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'condition_id' => Condition::factory(),
            'name' => $this->faker->word() . 'の商品',
            'brand_name' => 'テストブランド',
            'price' => 1000,
            'description' => 'テスト説明文',
            'img_url' => 'items/test.png',
        ];
    }
}