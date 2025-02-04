<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\PostForm;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class TrackersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        // 学習時間の秒数(カラム合計)
        $posts_total_seconds = $user->posts()
        ->sum('study_seconds');

        // 1万時間を秒に変換
        $goal_seconds = 10000 * 3600;

        // 学習進捗率
        $progress_percentage = floatval(number_format($posts_total_seconds / $goal_seconds * 100, 2));

        // 学習残り時間(秒)
        $remaining_seconds = max($goal_seconds - $posts_total_seconds, 0);
        // remaining_seconds を 時間・分に変換
        $hours = floor($remaining_seconds / 3600);
        $minutes = floor(($remaining_seconds % 3600) / 60);

        // 残り年数（1日8時間）
        $now = Carbon::now();
        // 目標達成日 = 現在 + 残りの学習時間
        $target_date = $now->copy()->addSeconds($remaining_seconds);
        // 現在の日付と目標日付の差分を取得
        $diff = $now->diff($target_date);

        // 正確な年・月・日を取得
        $years = $diff->y;
        $months = $diff->m;
        $days = $diff->d;

        // 記録回数
        $count = $user->posts()->count();

        // -------------------------------------
        // コレクションをオブジェクトのように扱う準備
        Collection::macro('toObject', function () {
            return json_decode(json_encode($this));
        });

        // コレクション
        $trackers = collect ([
            'progress_percentage' => $progress_percentage,
            'hours' => $hours,
            'minutes' => $minutes,
            'years' => $years,
            'months' => $months,
            'days' => $days,
            'count' => $count,
        ])->toObject();

        return view('trackers.index', compact('trackers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
