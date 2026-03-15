<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Condition;
use App\Models\User;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first() ?? User::factory()->create([
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);
        $items = [
            ['name' => '腕時計', 'price' => 15000, 'brand' => 'Rolax', 'desc' => 'スタイリッシュなデザインのメンズ腕時計', 'img' => 'Clock.jpg', 'cond' => '良好'],
            ['name' => 'HDD', 'price' => 5000, 'brand' => '西芝', 'desc' => '高速で信頼性の高いハードディスク', 'img' => 'HDD.jpg', 'cond' => '目立った傷や汚れなし'],
            ['name' => '玉ねぎ3束', 'price' => 300, 'brand' => 'なし', 'desc' => '新鮮な玉ねぎ3束のセット', 'img' => 'Onion.jpg', 'cond' => 'やや傷や汚れあり'],
            ['name' => '革靴', 'price' => 4000, 'brand' => '', 'desc' => 'クラシックなデザインの革靴', 'img' => 'Leather.jpg', 'cond' => '状態が悪い'],
            ['name' => 'ノートPC', 'price' => 45000, 'brand' => '', 'desc' => '高性能なノートパソコン', 'img' => 'Laptop.jpg', 'cond' => '良好'],
            ['name' => 'マイク', 'price' => 8000, 'brand' => 'なし', 'desc' => '高音質のレコーディング用マイク', 'img' => 'Mic.jpg', 'cond' => '目立った傷や汚れなし'],
            ['name' => 'ショルダーバッグ', 'price' => 3500, 'brand' => '', 'desc' => 'おしゃれなショルダーバッグ', 'img' => 'Purs.jpg', 'cond' => 'やや傷や汚れあり'],
            ['name' => 'タンブラー', 'price' => 500, 'brand' => 'なし', 'desc' => '使いやすいタンブラー', 'img' => 'Tumbler.jpg', 'cond' => '状態が悪い'],
            ['name' => 'コーヒーミル', 'price' => 4000, 'brand' => 'Starbacks', 'desc' => '手動のコーヒーミル', 'img' => 'Coffee.jpg', 'cond' => '良好'],
            ['name' => 'メイクセット', 'price' => 2500, 'brand' => '', 'desc' => '便利なメイクアップセット', 'img' => 'Mascara.jpg', 'cond' => '目立った傷や汚れなし'],
        ];

        foreach ($items as $item) {

            $condition = Condition::where('content', $item['cond'])->first();

            Item::create([
                'user_id'      => $user->id,
                'condition_id' => $condition->id,
                'name'         => $item['name'],
                'brand_name'   => ($item['brand'] === 'なし' || $item['brand'] === '') ? null : $item['brand'],
                'price'        => $item['price'],
                'description'  => $item['desc'],
                'img_url'      => $item['img'],
            ]);
        }
    }
}
