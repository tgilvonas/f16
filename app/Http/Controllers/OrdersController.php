<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderAmount;
use App\Models\PrintFormat;
use App\Models\PrintType;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        return view('orders.index', [
            'orders' => auth()->user()->orders,
        ]);
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
        if (count($request->districts) > 0) {
            $districts = District::whereIn('id', $request->districts)->get();
            $districtCoefficient = max($districts->pluck('coefficient')->toArray());
        } else {
            $districts = [];
            $districtCoefficient = 1;
        }

        $printFormat = PrintFormat::find($request->print_format);
        $printType = PrintType::find($request->print_type);
        $orderAmount = OrderAmount::find($request->amount);

        $printFormatCoefficient = $printFormat->coefficient ?? 0;
        $printTypeCoefficient = $printType->coefficient ?? 0;
        $amountCoefficient = $orderAmount->coefficient ?? 0;
        $amount = $orderAmount->amount ?? 0;

        $total = $amount * $amountCoefficient * $districtCoefficient * $printFormatCoefficient * $printTypeCoefficient;

        Order::create([
            'order_status' => 'Naujas',
            'user_id' => auth()->user()->id,
            'user_name' => auth()->user()->name,
            'user_email' => auth()->user()->email,
            'districts' => json_encode($districts),
            'print_format_title' => $printFormat->title ?? '',
            'print_format_measurements' => $printFormat->measurements ?? '',
            'print_format_coefficient' => $printFormatCoefficient,
            'print_type_title' => $printType->title ?? '',
            'print_type_coefficient' => $printTypeCoefficient,
            'amount' => $amount,
            'amount_coefficient' => $amountCoefficient,
            'total' => $total,
            'payment_method_title' => 'Stripe',
            'layout_needed' => $request->get('layout_needed', 0),
            'invoice_needed' => $request->get('invoice_needed', 0),
            'flyer_text' => $request->get('flyer_text', ''),
            'distribution_date' => date('Y-m-d'), // TO BE CHANGED AND CONCLUDED!!!
        ]);

        return redirect()->route('orders.index')->with('message', 'Jūsų užsakymas sukurtas');
    }
}
