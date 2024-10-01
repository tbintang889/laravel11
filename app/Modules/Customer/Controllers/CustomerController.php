<?php

namespace App\Modules\Customer\Controllers;


use Illuminate\View\View;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Modules\Customer\Models\Customer;

use Illuminate\Contracts\Support\ValidatedData;

class CustomerController extends Controller
{
    public $title, $module, $menu, $dataValidation;
    function __construct()
    {
        $this->title = 'Customers';
        $this->menu = 'Customers';
        $this->module = 'Master';
        $this->dataValidation = [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email:filter|unique:customers,email',
        ];
    }

    public function index(): View
    {
        $customers = Customer::all();
        $data = [
            'customers' => $customers,
            'title' => $this->title,
            'module' => $this->module,
            'menu' => $this->menu,

        ];
        // dd();

        return view('Customer::index', $data);
    }
    public function create()
    {
        $data = [

            'title' => $this->title,
            'module' => $this->module,

        ];
        // dump(itemCategory::values());
        return view('Customer::form', $data);
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        $data = [

            'customer' => $customer,
            'title' => $this->title,
            'module' => $this->module,
        ];
        // dump($data);

        return view('Customer::form', $data);
    }


    public function store(Request $request)
    {

        $ValidatedData =  $request->validate($this->dataValidation);
        try {
            Customer::create($ValidatedData);
            return redirect()->route('customer.index')->with('success', 'customer berhasil ditambahkan');
        } catch (\Exception $e) {
            dd($e->getMessage());
            // Log::error('Gagal menambahkan item: ' . $e->getMessage());
            // return redirect()->back()->with('error', 'Gagal menambahkan item: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Customer $customer)
    {
        $validatedData = $request->validate($this->dataValidation);

        $customer->update($validatedData);


        return redirect()->route('customer.index')->with('success', 'customer berhasil ditambahkan');
    }
    public function destroy($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();

            Log::info('customer dihapus:', ['id' => $customer->id, 'name' => $customer->name]);
            return redirect()->route('customer.index')->with('success', 'customer berhasil dihapus');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('customer tidak dcustomerukan:', ['id' => $id]);
            return redirect()->route('customer.index')->with('error', 'customer tidak dcustomerukan');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus customer:', ['id' => $id, 'error' => $e->getMessage()]);
            return redirect()->route('customer.index')->with('error', 'Gagal menghapus customer: ' . $e->getMessage());
        }
    }
}
