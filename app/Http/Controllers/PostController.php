<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// やりとりするモデルを宣言する
use App\Models\Post;

class PostController extends Controller
{
    // 一覧ページ index
    public function index() {
        # postsテーブルの全データを新しい順で取得する
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    // 作成ページ create
    public function create() {
        return view('posts.create');
    }

    // 作成機能 store
    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();
        return redirect()->route('posts.index')->with('flash_message', '投稿が完了しました。');
    }

    // 詳細ページ show
    public function show(Post $post) {
        return view('posts.show', compact('post'));
        /* all()メソッドやget()メソッドは、collectionというクラスのインスタンスを戻り値として返す。collectionクラスは簡単にいえば配列をより使いやすくしたクラス、配列と同様にforeach文で中身を順番に取り出すことができる。変数をビューに渡すには、view()ヘルパーの第2引数にPHPのcompact()関数を指定する方法が一般的。compact()関数の引数にはビューに渡す変数名を文字列で指定するが、先頭の$（ドル記号）は不要なので注意！
        「compact()関数＝引数に渡された変数とその値から配列を作成し、戻り値として返す関数」
        */
    }

    // 更新ページ edit
    public function edit(Post $post) {
        return view('posts.edit', compact('post'));
    }

    // 更新機能 update
    public function update(Request $request, Post $post) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();
        return redirect()->route('posts.show', $post)->with('flash_message', '投稿を編集しました。');
    }

    // 削除機能 destory
    public function destroy(Post $post) {
        $post->delete();
        return redirect()->route('posts.index')->with('flash_message', '投稿を削除しました。');
    }
}
