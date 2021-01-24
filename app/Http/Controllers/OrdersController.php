<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\District;
use App\Models\OrderAmount;
use App\Models\PrintFormat;
use App\Models\PrintType;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        return view('orders.index');
    }

    public function create()
    {
        return view('orders.create', [
            'districts' => District::orderBy('name', 'asc')->get(),
            'amounts' => OrderAmount::orderBy('amount', 'asc')->get(),
            'printFormats' => PrintFormat::all(),
            'printTypes' => PrintType::all(),
        ]);
    }

    public function store(OrderRequest $request)
    {
        dd('Here should be the logic which saves order and redirects to index');
    }
}
