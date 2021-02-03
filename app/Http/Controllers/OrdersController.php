<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderAmount;
use App\Models\PrintFormat;
use App\Models\PrintType;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        $order = Order::create([
            'order_status' => 'Naujas',
            'user_id' => auth()->user()->id,
            'user_name' => auth()->user()->name,
            'user_email' => auth()->user()->email,
            'districts' => $districts,
            'print_format_title' => $printFormat->title ?? '',
            'print_format_measurements' => $printFormat->measurements ?? '',
            'print_format_coefficient' => $printFormatCoefficient,
            'print_type_title' => $printType->title ?? '',
            'print_type_coefficient' => $printTypeCoefficient,
            'amount' => $amount,
            'amount_coefficient' => $amountCoefficient,
            'total' => $total,
            'payment_method_title' => 'Stripe',
            'design_needed' => $request->get('design_needed', 0),
            'invoice_needed' => $request->get('invoice_needed', 0),
            'flyer_text' => $request->get('flyer_text', ''),
            'distribution_date' => date('Y-m-d'), // TO BE CHANGED AND CONCLUDED!!!
        ]);

        if ($request->get('design_needed', 0) == 1) {
            if ($request->hasFile('flyer_logo')) {
                $this->uploadFileFromRequest($request, 'flyer_logo', $order->id);
            }
            if ($request->has('additional_files')) {
                foreach ($request->file('additional_files') as $file) {
                    $this->uploadFileFromRequest($request, 'additional_files', $order->id, $file);
                }
            }
        } elseif ($request->get('design_needed', 0) == 0 && $request->hasFile('flyer_layout_file')) {
            $this->uploadFileFromRequest($request, 'flyer_layout_file', $order->id);
        }

        return redirect()->route('orders.index')->with('message', 'Jūsų užsakymas sukurtas');
    }

    public function uploadFileFromRequest($request, $type, $orderId, $file = null)
    {
        if (!file_exists(storage_path('uploads'))) {
            mkdir(storage_path('uploads'));
        }
        if (!file_exists(public_path('uploads'))) {
            mkdir(public_path('uploads'));
        }
        if (!file_exists(public_path('uploads/'.$orderId))) {
            mkdir(public_path('uploads/'.$orderId));
        }

        if (!isset($file)) {
            $file = $request->file($type);
        }

        $fileNameForUser = $file->getClientOriginalName();
        $fileNameForUserWithoutExtension = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileExtension = $file->getClientOriginalExtension();

        if (mb_strlen($fileNameForUserWithoutExtension) > 254) {
            $systemFileName = $fileNameForUser;
        } else {
            $lengthOfRandomString = 254 - 1 - mb_strlen($fileNameForUserWithoutExtension);
            $lengthOfRandomString = $lengthOfRandomString > 16 ? 16 : $lengthOfRandomString;

            $systemFileName = $fileNameForUserWithoutExtension.'_'.Str::random($lengthOfRandomString).'.'.$fileExtension;
        }

        $file->storeAs('uploads', $systemFileName);
        rename(storage_path('app/uploads').'/'.$systemFileName, public_path('uploads/'.$orderId).'/'.$systemFileName);

        $upload = Upload::create([
            'file_name_for_user' => $fileNameForUser,
            'system_file_name' => $systemFileName,
            'type' => $type,
            'order_id' => $orderId,
        ]);
    }

    public function view($id)
    {
        $order = Order::findOrFail($id);

        return view('orders.view', [
            'order' => $order,
            'flyerLogos' => $order->getFlyerLogos(),
            'additionalFiles' => $order->getAdditionalFiles(),
            'flyerLayoutFiles' => $order->getFlyerLayoutFiles(),
        ]);
    }
}
