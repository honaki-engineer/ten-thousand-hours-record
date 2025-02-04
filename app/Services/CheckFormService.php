<?php 
namespace App\Services;

class CheckFormService
{
  // ----- index -----
  public static function checkStatusThrough($posts) {
      // statusカラム：数字(DB側)→日本語の単語(クライアント側)に変更
      $posts = $posts->through(function ($post) {
        if ($post->status === 1) { $post->status_label = '仕事'; }
        if ($post->status === 2) { $post->status_label = '休み'; }
        if ($post->status === 3) { $post->status_label = 'その他'; }
        return $post;
      }); 

      return $posts;
    }

  // ----- show -----
  public static function checkStatus($post) {
      // statusカラム：数字(DB側)→日本語の単語(クライアント側)に変更
      if($post->status === 1){ $post->status_label = '仕事';}
      if($post->status === 2){ $post->status_label = '休み';}
      if($post->status === 3){ $post->status_label = 'その他';}

      return $post;
  }

  
}




?>