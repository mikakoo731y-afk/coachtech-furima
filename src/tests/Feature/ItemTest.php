<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    /** 1. 会員登録機能 & 16. メール認証 **/
    public function test_会員登録バリデーションとメール送信()
    {
        Notification::fake();

        $response = $this->post('/register', [
            'name' => '', 
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $response->assertSessionHasErrors([
            'name' => 'お名前を入力してください',
            'email' => 'メールアドレスを入力してください',
            'password' => 'パスワードを入力してください'
        ]);
        
        $response = $this->post('/register', [
            'name' => 'テスト太郎',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
        Notification::assertSentTo(User::where('email', 'test@example.com')->first(), VerifyEmail::class);
    }

    /** 2. ログイン & 3. ログアウト **/
    public function test_ログインとログアウト()
    {
        $user = User::factory()->create(['password' => bcrypt('password123')]);

        $this->post('/login', ['email' => $user->email, 'password' => 'wrong'])
             ->assertSessionHasErrors();

        $this->post('/login', ['email' => $user->email, 'password' => 'password123'])
             ->assertRedirect('/');
        
        $this->assertAuthenticatedAs($user);

        $this->post('/logout');
        $this->assertGuest();
    }

    /** 4. 商品一覧 & 6. 検索 **/
    public function test_一覧表示と検索()
    {
        $item = Item::factory()->create(['name' => 'ターゲット商品']);
        
        $this->get('/')->assertStatus(200)->assertSee('ターゲット商品');
        $this->get('/?keyword=ターゲット')->assertSee('ターゲット商品');
    }

    /** 4 & 5. Sold表示 **/
    public function test_購入済み商品のSold表示()
    {
        $item = Item::factory()->create();
        // Purchaseモデルとのリレーションを確認してください
        $item->purchases()->create([
            'user_id' => User::factory()->create()->id,
            'payment_method' => 'card',
            'shipping_address' => '東京都...',
        ]);

        $this->get('/')->assertSee('Sold');
    }

    /** 8. いいね機能 **/
    public function test_いいねの切り替え()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();
        $this->actingAs($user);

        // いいね実行 (ルート名は確認してください)
        $this->post("/item/like/{$item->id}");
        $this->assertDatabaseHas('likes', ['user_id' => $user->id, 'item_id' => $item->id]);

        // いいね解除
        $this->post("/item/like/{$item->id}");
        $this->assertDatabaseMissing('likes', ['user_id' => $user->id]);
    }

    /** 10. 購入機能 **/
    public function test_購入処理のバリデーション()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();
        $this->actingAs($user);

        $response = $this->post("/purchase/{$item->id}", [
            'payment_method' => '',
            'shipping_address' => '',
        ]);
        $response->assertSessionHasErrors(['payment_method', 'shipping_address']);
    }

    /** 15. 出品機能 **/
    public function test_商品出品()
    {
        Storage::fake('public'); // 画像保存のシミュレーション
        $file = UploadedFile::fake()->image('test.jpg'); // テスト用画像

        $user = User::factory()->create();
        $condition = Condition::factory()->create();
        $this->actingAs($user);

        // ExhibitionRequestのバリデーション項目をすべて網羅
        $response = $this->post('/sell', [
            'name'         => '出品テスト商品',
            'description'  => 'テスト説明文',
            'price'        => 500,
            'condition_id' => $condition->id,
            'categories'   => [1], // CategoryController等で使う名前に合わせる
            'img_url'      => $file, // 必須の画像を追加
        ]);

        $this->assertDatabaseHas('items', ['name' => '出品テスト商品']);
    }
}
