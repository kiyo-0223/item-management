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
        $typeId = $request->input('typesId');  //種別の値
        // dd($typeId);
        $query = Item::leftJoin("types", "items.type_id", "types.id")
            ->select([
                "items.id",
                "items.name",
                "detail",
                "code",
                "quantity",
                "types.name as type_name"
            ]);
        if (!empty($keyword)) {
            $query->where(function ($query) use ($keyword) {
                $query->orWhere('items.name', 'LIKE', "%{$keyword}%")
                    ->orWhere('code', 'LIKE', "%{$keyword}%")
                    ->orWhere('detail', 'LIKE', "%{$keyword}%")
                    ->orWhere('quantity', 'LIKE', "%{$keyword}%")
                    ->orWhere('items.id', 'LIKE', "%{$keyword}%");
            });
        }

        if (!empty($typeId)) {
            $query->Where('types.id', $typeId);
        }

        $items = $query
            ->orderBy("items.created_at", "DESC")
            ->get();
        $types = Type::all();

        return view('item.index', compact('items', 'types', 'keyword', 'typeId'));
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
                'name' => 'required|string|max:20',
                'code' => 'required|integer|min:0|max:10000000000',
                'type_id' => 'required|integer|max:225',
                'detail' => 'required|string|max:200',
                'quantity' => 'required|integer|min:0|max:10000',
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
            'name' => 'required|string|max:20',
            'code' => 'required|integer|min:0|max:10000000000',
            'type_id' => 'required|integer|max:225',
            'detail' => 'required|string|max:200',
            'quantity' => 'required|integer|min:0|max:10000',
        ]);

        $item = Item::find($id);
        $item->name = $request->name;
        $item->code = $request->code;
        $item->type_id = $request->type_id;
        $item->detail = $request->detail;
        $item->quantity = $request->quantity;
        $item->save();

        return redirect('/item');
    }

    // 削除ボタンを押したとき
    public function itemDelete(Request $request, $id)
    {
        $item = Item::where('id', '=', $request->id)->first();
        $item->delete();
        return redirect('/items');
    }

    // 仕入れ処理
    public function purchase(Request $request)
    {
        // 検索フォームで入力された値を取得
        $code = $request->input('code');  //商品コード
        $query = Item::select([
            "id",
            "name",
            "code",
            "quantity",
        ]);
        if (!empty($code)) {
            $query->Where('code', $code);
        }
        $items = $query->get();
        return view('/item/purchase', compact('items', 'code'));
    }
    public function addPurchase(Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $item = Item::where('id','=',$request->id)->first();

        $add = $request->quantity;
        // dd($add);
        $quantity = $item->quantity + $add;
        $item->update(['quantity' => $quantity]);
        $item->save();
        return redirect('/items/purchase')->with('flashmessage','仕入れ処理が完了しました。');
    }
    
}
