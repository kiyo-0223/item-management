<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\User;
use App\Models\Type;
use Illuminate\Support\Facades\DB;

class TypeController extends Controller
{
    // 管理画面表示
    public function management()
    {
        return view('/type/management');
    }

    /**
     * 種別登録ページ表示
     */
    public function type()
    {
        $types = Type::all();
        return view('/type/type', ['types' => $types]);
    }

    public function typeAdd(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|max:255',
        ]);

        // 種別登録
        Type::create([
            'name' => $request->name,
        ]);
        return redirect('/types/type');
    }

    // 種別編集ページにとぶ
    public function typeEdit(Request $request)
    {
        $types = Type::where('id', '=', $request->id)->first();
        // itemテーブルでIDが使用されてるかカウントで確認する=>bladeで0以上だと削除ボタンがでないように
        $item = Item::where('type_id', '=', $request->id)->count();
        // dd($item);
        return view('/type/type_edit', ['types' => $types, 'items' => $item]);
    }

    // 編集ボタンを押したとき
    public function typeEditPush(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $type = Type::find($id);
        $type->name = $request->name;
        $type->save();

        return redirect('/types/type');
    }

    // 削除ボタンを押したとき
    public function typeDelete(Request $request, $id)
    {
        // 外部キー制約を一時的に外す
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $type = Type::where('id', '=', $request->id)->first();
        $type->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return redirect('/types/type');
    }

    /**
     * 権限変更ページ表示
     */
    public function role(Request $request)
    {
        $users = User::all();
        return view('/type/role', compact('users'));
    }
        // 権限編集ボタンを押したとき
        public function roleEdit(Request $request)
        {
                // $user = User::where('id','=',$request->id)->first();
                $user = User::where('id','=',$request->id)->first();
                // dd($request);
                $user->role = $request->role;
                $user->save();
            return redirect('/types/role');
        }

}
