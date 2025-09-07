# 1万時間学習記録アプリ

## 概要

学習時間を記録・可視化することで、**「1万時間の法則」の到達**という目標達成をサポートする Laravel 製アプリです。  
ユーザーは日々の学習を記録し、自動算出された**累計時間・残り時間・達成率**を確認できます。  
また、ログイン機能やバリデーション、エラーページ対応など、使いやすさにも配慮した設計となっています。

---

## デモサイト

🔗 アプリ  
  <https://ten-thousand-hours-record.akkun1114.com/>  
🔗 ゲストログイン（今すぐ試せます）  
  <https://ten-thousand-hours-record.akkun1114.com/guest-login?token=guest123>  

### ゲストログイン情報
- メールアドレス：不要
- パスワード：不要

上記のURLをクリックするだけで、ゲストログインが完了します。

---

## 目次

- [概要](#概要)
- [デモサイト](#デモサイト)
- [使用技術](#使用技術)
- [主な機能](#主な機能)
- [セットアップ前に必要なもの](#セットアップ前に必要なもの)
- [セットアップ手順](#セットアップ手順)
- [ディレクトリ構成](#ディレクトリ構成)
- [本番環境の注意点](#本番環境の注意点)
  
---

## 使用技術

- **フロントエンド**：HTML / JavaScript / Tailwind CSS  
- **バックエンド**：PHP 8.2 / Laravel 9.x  
- **データベース**：MySQL 8.0（開発: MAMP） / MariaDB 10.5（本番: Xserver、MySQL互換）  
- **インフラ・環境**：MAMP / macOS Sequoia 15.3.1 / Xserver  
- **ビルド環境**：Node.js 22.17.0（開発） / Node.js 16.20.2（本番: Xserver に nodebrew で導入） / Composer 2.x  
- **開発ツール**：VSCode / Git / GitHub / phpMyAdmin  
  
※ ローカル開発環境は、 Node.js 22.x を使用してビルドを実行しています。  
本番環境（Xserver）は、nodebrew を利用して Node.js 16.20.2 を導入し、ビルドを行っています。  
なお、Xserver では Node.js の標準提供は行われていないため、サーバー内ビルドは公式サポート対象外の構成となります。  
必要に応じて、ローカルビルド済みのファイルをアップロードする運用をおすすめいたします。

---

## 主な機能
### 開発者目線

- **認証/認可**：Breeze、全ルート `auth` / 取得は本人スコープ固定
- **ゲストログイン**（ワンクリック）
- **学習記録**：CRUD
- **ステータス自動ラベル変換**（数値 → 日本語）
- **学習時間のフォーマット変換**（秒 → 時間 / 分）
- **学習進捗の可視化**（残り時間 / 達成率）
- **400〜503**：カスタムエラーページ
- **その他**：バリデーション / 入力保持（old関数） / バリデーションエラーメッセージ表示 / ページネーション

### ユーザー目線
#### 区分別 機能対応表

| 機能                      | 非ログインユーザー | 一般ユーザー |
| -----------------------  | --------------- | ---------- |
| 新規登録・ログイン          | ●                | ●      |
| パスワード再発行            | ●               | ●      |
| ゲストログイン（1クリック）   | ●               | -      |
| 学習記録の閲覧              | -               | ●      |
| 学習記録の作成              | -               | ●      |
| 学習記録の編集              | -               | ●      |
| 学習記録の削除              | -               | ●      |
| 累計・残り時間・達成率の表示  | -                | ●      |
| プロフィール編集            | -                | ●      |

---

## セットアップ前に必要なもの

- PHP 8.2 以上
- Composer 2.x
- DB：MySQL 8.0 もしくは MariaDB 10.5（MySQL互換）
- Node.js（Tailwind をビルド）
- Git（クローンする場合）

.env の `DB_` 各項目などは、Xserver または開発の環境に応じて適宜変更してください。

### .env 設定例（開発用）

```env
APP_NAME=1万時間学習記録
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ten_thousand_hours_record
DB_USERNAME=root
DB_PASSWORD=root

# Mailpit を使う場合
MAIL_MAILER=smtp
MAIL_HOST=localhost
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

GUEST_LOGIN_TOKEN=guest123
```

### .env 設定例（本番用）

```env
APP_NAME=1万時間学習記録
APP_ENV=production
APP_DEBUG=false
APP_URL=https://example.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=（本番用 データベース）
DB_USERNAME=（本番用 ユーザー）
DB_PASSWORD=（本番用 DBuser パスワード）

# Gmail の場合
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=（使用するメールアドレス）
MAIL_PASSWORD=（16桁のアプリパスワード）
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=（使用するメールアドレス）
MAIL_FROM_NAME="${APP_NAME}"

GUEST_LOGIN_TOKEN=guest123
```

---

## セットアップ手順

1. リポジトリをクローン
```bash
git clone https://github.com/honaki-engineer/ten-thousand-hours-record.git
cd ten-thousand-hours-record
```
2. 環境変数を設定
```bash
cp .env.example .env
```
3. PHPパッケージをインストール
- 開発
```bash
composer install
```
- 本番
```bash
composer install --no-dev --optimize-autoloader
```

4. アプリケーションキーを生成
```bash
php artisan key:generate
```
5. DBマイグレーション & 初期データ投入
```bash
php artisan migrate --seed
```
6. フロントエンドビルド (Tailwind/Vite 使用時)
- 開発
```bash
npm install
npm run dev
```

- 本番
```bash
npm install
npm run build
```

7. サーバー起動 (ローカル開発用)
```bash
php artisan serve
```

---

## ディレクトリ構成

```txt
ten-thousand-hours-record/
├── app/                     # アプリケーションロジック (モデル、サービスなど)
├── config/                  # 各種設定ファイル
├── database/
│   ├── migrations/          # マイグレーションファイル
│   └── seeders/             # 初期データ投入用
├── public/
│   └── index.php            # エントリーポイント
├── resources/
│   ├── views/               # Bladeテンプレート
│   ├── css/                 # カスタムCSS
│   └── js/                  # カスタムJS
├── routes/
│   └── web.php              # ルーティング設定
├── .env.example             # 環境変数のテンプレート
├── composer.json            # PHPパッケージ管理
├── package.json             # Node.js用パッケージ管理 (Tailwind/Viteなど)
├── vite.config.js           # Vite設定
├── tailwind.config.js       # Tailwind CSSの設定
└── README.md
```

---

## 本番環境の注意点

Xserver 上で Laravel アプリを本番公開する際の詳細な手順 (SSH 接続、`.env` 設定、`.htaccess` 配置、`index.php` 修正、ビルドファイルの配置など) は、以下の記事にまとめています：

- メインドメインの場合  
  https://qiita.com/honaki/items/bf82986954c7db568094

- サブドメインの場合  
  https://qiita.com/honaki/items/a9c01bb8ae753ed67add
