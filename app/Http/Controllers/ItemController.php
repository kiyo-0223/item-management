<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\User;

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

        if(!empty($keyword)) {
            $query->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('type', 'LIKE', "%{$keyword}%")
                ->orWhere('code', 'LIKE', "%{$keyword}%")
                ->orWhere('detail', 'LIKE', "%{$keyword}%")
                ->orWhere('quantity', 'LIKE', "%{$keyword}%")
                ->orWhere('id', 'LIKE', "%{$keyword}%");
        }
        $items = $query->latest()->get();

        return view('item.index',compact('items', 'keyword'));

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
                'name' => 'required|max:100',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'code' => $request->code,
                'type' => $request->type,
                'detail' => $request->detail,
                'quantity' => $request->quantity,
            ]);

            return redirect('/items');
        }

        return view('item.add');
    }

    /**
     * 商品編集
     */
    public function itemEdit(Request $request){
        $items = Item::where('id', '=', $request->id)->first();
        return view('item.edit',['items'=>$items]);
    }

    // 編集ボタンを押したとき
    public function itemModify(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|max:255',
            'type' => 'required|max:255',
            'detail' => 'required|max:255',
            'quantity' => 'required|max:255',
        ]);

        $item = Item::find($id);
        $item->name = $request->name;
        $item->code = $request->code;
        $item->type = $request->type;
        $item->detail = $request->detail;
        $item->quantity = $request->quantity;
        $item->save();

        return redirect('/items');
    }

    // 削除ボタンを押したとき
    public function itemDelete(Request $request, $id)
    {
        $item = Item::where('id','=',$request->id)->first();
        $item->delete();
        return redirect('/items');
    }
}
