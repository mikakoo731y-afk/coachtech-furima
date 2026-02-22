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
        $items = [
            ['name' => '腕時計', 'price' => 15000, 'brand' => 'Rolax', 'desc' => 'スタイリッシュなデザインのメンズ腕時計', 'img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com', 'cond' => '良好'],
            ['name' => 'HDD', 'price' => 5000, 'brand' => '西芝', 'desc' => '高速で信頼性の高いハードディスク', 'img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com', 'cond' => '目立った傷や汚れなし'],
            ['name' => '玉ねぎ3束', 'price' => 300, 'brand' => 'なし', 'desc' => '新鮮な玉ねぎ3束のセット', 'img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com', 'cond' => 'やや傷や汚れあり'],
            ['name' => '革靴', 'price' => 4000, 'brand' => '', 'desc' => 'クラシックなデザインの革靴', 'img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com', 'cond' => '状態が悪い'],
            ['name' => 'ノートPC', 'price' => 45000, 'brand' => '', 'desc' => '高性能なノートパソコン', 'img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com', 'cond' => '良好'],
            ['name' => 'マイク', 'price' => 8000, 'brand' => 'なし', 'desc' => '高音質のレコーディング用マイク', 'img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com', 'cond' => '目立った傷や汚れなし'],
            ['name' => 'ショルダーバッグ', 'price' => 3500, 'brand' => '', 'desc' => 'おしゃれなショルダーバッグ', 'img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com', 'cond' => 'やや傷や汚れあり'],
            ['name' => 'タンブラー', 'price' => 500, 'brand' => 'なし', 'desc' => '使いやすいタンブラー', 'img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com', 'cond' => '状態が悪い'],
            ['name' => 'コーヒーミル', 'price' => 4000, 'brand' => 'Starbacks', 'desc' => '手動のコーヒーミル', 'img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com', 'cond' => '良好'],
            ['name' => 'メイクセット', 'price' => 2500, 'brand' => '', 'desc' => '便利なメイクアップセット', 'img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com', 'cond' => '目立った傷や汚れなし'],
        ];

        // 最初のユーザーを取得（紐付け用）
        $user = User::first();

        foreach ($items as $item) {
            // コンディション名からIDを取得
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
