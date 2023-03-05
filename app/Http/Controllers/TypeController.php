<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\User;
use App\Models\Type;

class TypeController extends Controller
{
    // 管理画面表示
    public function management()
    {
        return view('/type/management');
    }

    public function roleEdit()
    {
        return view('/type/role');
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

    // 種別編集
        public function typeEdit()
    {
        return view('/type/type_edit');
    }




    
}
