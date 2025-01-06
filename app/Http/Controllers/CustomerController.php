<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = User::where('role', 'customer')->get();

        return view('admin.customer.index', compact('customer'));
    }

    public function destroy(string $id)
    {
        $customer = User::where('id', $id)->first();

        $customer->delete();

        return back()->with('success', 'Data Customer Berhasil Dihapus');
    }
}
