<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        // フォームから受け取るデータのキー（name属性）
        // ただし、DBに保存するもののみ
        'study_seconds',
        'status',
        'comment',
        'user_id',
    ];

    // リレーション
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
}
