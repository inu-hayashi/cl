<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

//使うClassを宣言
use App\Coping;
use Validator;
use Auth;

class CopingsController extends Controller
{
         public function __construct()
    {
        $this->middleware('auth');
    }

    //リスト表示
    public function index()
    {
         $copings = Coping::where('user_id',Auth::user()->id)
         ->orderBy('created_at', 'desc')
         ->paginate(10);
         $auths = Auth::user();
         return view('copings', [
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
            'id' => 'required',
            'item_name' => 'required|max:255',
            'item_satisfaction' => 'required|max:6',
        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        $books = Coping::find($request->id);
        $books->item_name   = $request->item_name;
        $books->item_satisfaction = $request->item_satisfaction;
        $books->save();
        return redirect('/');
    }

    //登録
    public function store(Request $request) {
        //バリデーション
        $validator = Validator::make($request->all(), [
                'item_name' => 'required|max:255',
                // 'item_satisfaction' => 'required|max:6',
        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
                return redirect('/')
                    ->withInput()
                    ->withErrors($validator);
        }
        // 本作成処理...
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
