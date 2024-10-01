<?php

namespace App\Modules\Item\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Modules\Item\Models\Item;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\itemCategory;
use Illuminate\Contracts\Support\ValidatedData;
use Spatie\Permission\Models\Permission;

class ItemController extends Controller
{
    public $title, $module, $menu;
    function __construct()
    {
        $this->title = 'Items';
        $this->menu = 'Items';
        $this->module = 'Master';
    }

    public function index(): View
    {
        $items = Item::all();
        $data = [
            'items' => $items,
            'title' => $this->title,
            'module' => $this->module,
            'menu' => $this->menu,

        ];
        // dd();

        return view('Item::index', $data);
    }
    public function create()
    {
        $data = [
            'categories' => itemCategory::values(),
            'title' => $this->title,
            'module' => $this->module,

        ];
        // dump(itemCategory::values());
        return view('Item::form', $data);
    }

    public function edit($id)
    {
        $Item = Item::findOrFail($id);
        $data = [
            'categories' => itemCategory::values(),
            'item' => $Item,
            'title' => $this->title,
            'module' => $this->module,
        ];
        // dump($data);

        return view('Item::form', $data);
    }


    public function store(Request $request)
    {
        $ValidatedData =  $request->validate([
            'name' => 'required',
            'category' => 'required',
            'unit_price' => 'decimal:0'
        ]);
        // dump($ValidatedData);
        try {
            Item::create($ValidatedData);
            return redirect()->route('item.index')->with('success', 'item berhasil ditambahkan');
        } catch (\Exception $e) {
            dd($e->getMessage());
            // Log::error('Gagal menambahkan item: ' . $e->getMessage());
            // return redirect()->back()->with('error', 'Gagal menambahkan item: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Item $Item)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'unit_price' => 'decimal:0'
        ]);

        $Item->update($validatedData);


        return redirect()->route('item.index')->with('success', 'item berhasil ditambahkan');
    }
    public function destroy($id)
    {
        try {
            $Item = Item::findOrFail($id);
            $Item->delete();

            Log::info('Item dihapus:', ['id' => $Item->id, 'name' => $Item->name]);
            return redirect()->route('item.index')->with('success', 'Item berhasil dihapus');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Item tidak ditemukan:', ['id' => $id]);
            return redirect()->route('item.index')->with('error', 'Item tidak ditemukan');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus Item:', ['id' => $id, 'error' => $e->getMessage()]);
            return redirect()->route('item.index')->with('error', 'Gagal menghapus Item: ' . $e->getMessage());
        }
    }
}
