**coachtechフリマ (coachtech-furima)**

**1. 環境構築の手順**

**Dockerビルド**

git clone https://github.com/mikakoo731y-afk/coachtech-furima

cd contact-app

docker-compose up -d --build

**Laravel環境構築**

docker-compose exec php bash

composer install

cp .env.example .env

**データベース構築**

php artisan key:generate

php artisan migrate:fresh --seed

**2. 開発環境URL**

- **TOP画面:** http://localhost:8080
- **登録ページ:** 
- **phpMyAdmin:** http://localhost:8080

**3. 使用技術（実行環境）**

**言語・フレームワーク**
- **PHP:** 8.x
- **Laravel:** 8.x
- **Laravel Fortify:** 認証機能（ログイン・登録・ログアウト）の実装に使用

**データベース・ミドルウェア**
- **MySQL:** 8.0
- **Nginx:** 最新版
- **phpMyAdmin:** データベース管理用

**開発インフラ**
- **Docker / Docker Compose:** 開発環境のコンテナ化
- **Laravel Sail:** Docker環境の操作・管理

**主要な実装機能（バリデーション等**
- **FormRequest:** ユーザー側および管理者側の入力バリデーションに使用
- **Eloquent Factory / Seeder:** テストデータ（35件）および初期カテゴリーデータの生成
- **Laravel Blade:** フロントエンド（ユーザー画面・管理者画面）の構築

**4.ER図**
```mermaid

erDiagram
    users ||--o| profiles : "1対1 (詳細情報)"
    users ||--o{ items : "出品する"
    users ||--o{ likes : "お気に入り登録"
    users ||--o{ comments : "コメント投稿"
    users ||--o{ purchases : "商品購入"

    items ||--o{ item_category : "カテゴリ紐付け"
    categories ||--o{ item_category : "カテゴリ分類"
    
    conditions ||--o{ items : "商品の状態"
    
    items ||--o{ likes : "被お気に入り"
    items ||--o{ comments : "被コメント"
    items ||--o| purchases : "販売完了"

    users {
        unsigned_bigint id PK
        varchar email UK "メールアドレス"
        varchar password "パスワード"
        timestamp email_verified_at "メール認証日"
        timestamp created_at
        timestamp updated_at
    }

    profiles {
        unsigned_bigint id PK
        unsigned_bigint user_id FK "Users参照"
        varchar name "表示名"
        varchar img_url "プロフィール画像"
        varchar postal_code "郵便番号"
        varchar address "住所"
        varchar building "建物名"
    }

    categories {
        unsigned_bigint id PK
        varchar content "カテゴリ名"
    }

    conditions {
        unsigned_bigint id PK
        varchar content "状態名"
    }

    items {
        unsigned_bigint id PK
        unsigned_bigint user_id FK "出品者ID"
        unsigned_bigint condition_id FK "状態ID"
        varchar name "商品名"
        integer price "販売価格"
        text description "商品説明"
        varchar img_url "商品画像"
    }

    item_category {
        unsigned_bigint id PK
        unsigned_bigint item_id FK
        unsigned_bigint category_id FK
    }

    likes {
        unsigned_bigint id PK
        unsigned_bigint user_id FK
        unsigned_bigint item_id FK
    }

    comments {
        unsigned_bigint id PK
        unsigned_bigint user_id FK
        unsigned_bigint item_id FK
        text content "コメント本文"
    }

    purchases {
        unsigned_bigint id PK
        unsigned_bigint user_id FK "購入者ID"
        unsigned_bigint item_id FK "商品ID"
        varchar payment_method "支払い方法"
        varchar shipping_address "配送先住所"
    }
```