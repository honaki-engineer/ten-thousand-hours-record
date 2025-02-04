<?php 
namespace App\Services;

class checkFormService
{
  // ----- index -----
  public static function checkStatusThrough($posts) {
      // statusカラム：数字(DB側)→日本語の単語(クライアント側)に変更
      // コレクション型のため、transformを使用
      $posts->through(function ($post) {
        if($post->status === 1){ $post->status = '仕事';}
        if($post->status === 2){ $post->status = '休み';}
        if($post->status === 3){ $post->status = 'その他';}
        return $post;
      });
  }

  // ----- show -----
  public static function checkStatus($post) {
      // statusカラム：数字(DB側)→日本語の単語(クライアント側)に変更
      // 表示用の変数
      if($post->status === 1){ $status = '仕事';}
      if($post->status === 2){ $status = '休み';}
      if($post->status === 3){ $status = 'その他';}

      return $status;
  }

  
}




?>