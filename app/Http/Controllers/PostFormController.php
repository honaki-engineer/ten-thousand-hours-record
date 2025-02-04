<?php

namespace App\Http\Controllers;

use App\Models\PostForm;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\checkFormService;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;


class PostFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Auth::user()
        ->posts()
        ->orderBy('date', 'desc')
        ->paginate(20)
        ->through(function ($post) { // study_seconds を 時間・分に変換
            $post->hours = floor($post->study_seconds / 3600);
            $post->minutes = floor(($post->study_seconds % 3600) / 60);
            return $post;
        });  

        // statusカラム：数字(DB側)→日本語の単語(クライアント側)に変更
        $status = checkFormService::checkStatusThrough($posts);
        
        return view('posts.index', compact('posts', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // バリデーションエラーメッセージのname属性
        $errorNames = ['date', 'hours', 'minutes', 'status', 'comment'];

        return view('posts.create', compact('errorNames'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        // 秒に変換
        $studySeconds = ($request->hours * 3600) + ($request->minutes * 60);

        PostForm::create([
            'date' => $request->date,
            'study_seconds' => $studySeconds,
            'status' => $request->status,
            'comment' => $request->comment,
            'user_id' => Auth::id(),
        ]);

        return to_route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Auth::user()->posts()->findOrFail($id);

        // study_seconds を 時間・分に変換
        // データベースにないプロパティを動的に追加
        $post->hours = floor($post->study_seconds / 3600);
        $post->minutes = floor(($post->study_seconds % 3600) / 60);

        // statusカラム：数字(DB側)→日本語の単語(クライアント側)に変更
        $status = checkFormService::checkStatus($post);

        return view('posts.show', compact('post', 'status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Auth::user()->posts()->findOrFail($id);

        // 厳密比較のため、float型→int型に変更
        $post->hours = (int)floor($post->study_seconds / 3600);
        $post->minutes = (int)floor(($post->study_seconds % 3600) / 60);

        // バリデーションエラーメッセージのname属性
        $errorNames = ['date', 'hours', 'minutes', 'status', 'comment'];

        return view('posts.edit', compact('post', 'errorNames'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Auth::user()
        ->posts()
        ->findOrFail($id);

        // 秒に変換
        $studySeconds = ($request->hours * 3600) + ($request->minutes * 60);

        $post->update([
            'date' => $request->date,
            'study_seconds' => $studySeconds,
            'status' => $request->status,
            'comment' => $request->comment,
        ]);

        return to_route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Auth::user()
        ->posts()
        ->findOrFail($id);

        $post->delete();

        return to_route('posts.index');
    }
}