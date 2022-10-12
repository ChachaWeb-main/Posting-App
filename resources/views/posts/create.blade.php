<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規投稿</title>
</head>

<body>
    <header>
        <nav>
            <div>
                <a href="{{ route('posts.index') }}">投稿アプリ</a>
            </div>
        </nav>
    </header>

    <main>
        <article>
            <div>
                <h1>新規投稿</h1>

                {{-- 変数$errors（MessageBagクラスのインスタンス）に対してany()メソッドを使うことで、エラーが1つ以上存在する場合にTRUEを返す。「エラーが1つでも存在すれば」処理を実行 --}}
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div>
                    <a href="{{ route('posts.index') }}">&lt; 戻る</a>
                </div>

                <form action="{{ route('posts.store') }}" method="post">
                    @csrf
                    <div>
                        <label for="title">タイトル</label>
                        {{-- エラー時の入力保持のために、old()ヘルパーの引数にフォームのname属性の値を指定することで、そのフォームの直前の入力値を取得できる。 --}}
                        <input type="text" name="title" value="{{ old('title') }}">
                    </div>
                    <div>
                        <label for="content">本文</label>
                        <textarea name="content">{{ old('content') }}</textarea>
                    </div>
                    <button type="submit">投稿</button>
                </form>
            </div>
        </article>
    </main>

    <footer>
        <p>&copy; 投稿アプリ All rights reserved.</p>
    </footer>
</body>

</html>
