<?php

namespace App\Http\Controllers;

//使うClassを宣言
use Illuminate\Http\Request;
use App\Coping;
use Validator;
// 認証モデルを使用する
use Auth;


class CopingsController extends Controller
{       
        // コンストラクタ(このクラスが呼ばれたら最初に処理する)
         public function __construct()
    {
        // 認証機能を使う
        $this->middleware('auth');
    }

    //リスト表示
    public function index()
    {
        // ログインユーザーの情報取得
         $copings = Coping::where('user_id',Auth::user()->id)
         // 新しい順に並べる
         ->orderBy('created_at', 'desc')
         // ページネーション(10ずつ)
         ->paginate(10);
         $auths = Auth::user();
         // viewのcopings.blade.phpを表示
         return view('copings', [
             // 第二引数はビューに使用するデータを受け取る。
            // ビューで使用する変数名 => 値(変数/配列/オブジェクト)
            'copings' => $copings,
            'auths' => $auths
         ]);
    }

    //更新画面
    public function edit($copings_id)
    {
        $copings = Coping::where('user_id',Auth::user()->id) -> find($copings_id);
        return view('copingsedit', [
            'coping' => $copings
        ]);
    }

    //更新
    public function update(Request $request) {
        //バリデーション
        $validator = Validator::make($request->all(), [
            // アイテムid(必須)
            'id' => 'required',
            // アイテム名(必須、255字以内)
            'item_name' => 'required|max:255',
            // 満足度(必須)
            'item_satisfaction' => 'required',
        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
            // ルートへ移動
            return redirect('/')
            // セッションを保存
                ->withInput()
                // バリデーション内容表示
                ->withErrors($validator);
        }
        // モデルCopingに対して値を更新
        // 「copingsテーブルのid値」と「findで指定したid値」の等しいレコードを取得
        $copings = Coping::find($request->id);
        $copings->item_name   = $request->item_name;
        $copings->item_satisfaction = $request->item_satisfaction;
        $copings->save();
        return redirect('/');
    }

    //リストの登録
    // Requestモデルを通して$requestに1レコードの値を受け取る
    public function store(Request $request) {
        //バリデーション
        $validator = Validator::make($request->all(), [
                'item_name' => 'required|max:255',
                // 'item_satisfaction' => 'required',
        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
                return redirect('/')
                    ->withInput()
                    ->withErrors($validator);
        }
        // 作成処理
        // モデルCopingに対して値を代入し保存
        $copings = new Coping;
        $copings->user_id = Auth::user()->id;
        $copings->item_name = $request->item_name;
        $copings->item_satisfaction = $request->item_satisfaction;
        $copings->save();
        return redirect('/');
    }

    //削除処理
    public function destroy(Coping $coping)
    {
        $coping->delete();
        return redirect('/');
    }
}
