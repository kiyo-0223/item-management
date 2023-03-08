<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\User;
use App\Models\Type;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index(Request $request)
    {
        // 検索フォームで入力された値を取得
        $keyword = $request->input('keyword');

        $query = Item::query();

        if (!empty($keyword)) {
            $query->where('items.name', 'LIKE', "%{$keyword}%")
                ->orWhere('types.name type_name', 'LIKE', "%{$keyword}%")
                ->orWhere('code', 'LIKE', "%{$keyword}%")
                ->orWhere('detail', 'LIKE', "%{$keyword}%")
                ->orWhere('quantity', 'LIKE', "%{$keyword}%")
                ->orWhere('items.id', 'LIKE', "%{$keyword}%");
        }

        $items = $query
            ->leftJoin("types", "items.type_id", "types.id")
            ->select([
                "items.id",
                "items.name",
                "detail",
                "code",
                "quantity",
                "types.name as type_name"
            ])
            ->orderBy("items.created_at", "DESC")
            ->get();
        $types = Type::all();

        return view('item.index', compact('items', 'types', 'keyword'));
    }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:255',
                'code' => 'required|max:255',
                'type_id' => 'required|max:255',
                'detail' => 'required|max:255',
                'quantity' => 'required|max:255',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'code' => $request->code,
                'type_id' => $request->type_id,
                'detail' => $request->detail,
                'quantity' => $request->quantity,
            ]);

            return redirect('/items');
        }
        $types = Type::all();

        return view('item.add', compact('types'));
    }

    /**
     * 商品編集ページにとぶ
     */
    public function item(Request $request)
    {
        $items = Item::where('id', '=', $request->id)->first();
        
        $types = Type::all();
        // 変数を渡す
        return view('item.edit', ['items' => $items, 'types' => $types]);
    }

    // 編集ボタンを押したとき
    public function itemEdit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|max:255',
            'type_id' => 'required|max:255',
            'detail' => 'required|max:255',
            'quantity' => 'required|max:255',
        ]);

        $item = Item::find($id);
        $item->name = $request->name;
        $item->code = $request->code;
        $item->type_id = $request->type_id;
        $item->detail = $request->detail;
        $item->quantity = $request->quantity;
        $item->save();

        return redirect('/items');
    }

    // 削除ボタンを押したとき
    public function itemDelete(Request $request, $id)
    {
        $item = Item::where('id', '=', $request->id)->first();
        $item->delete();
        return redirect('/items');
    }
}
