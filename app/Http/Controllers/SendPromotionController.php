<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Promotion;
use App\Models\SendPromotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PromotionMail;

class SendPromotionController extends Controller
{
    public function index()
    {
        $sendPromotions = SendPromotion::with(['customer', 'promotion'])->get();
        return view('admin.send-promotions.index', compact('sendPromotions'));
    }

    public function create()
    {
        $customers = Customer::all();
        $promotions = Promotion::where('is_active', 1)->get();
        return view('admin.send-promotions.create', compact('customers', 'promotions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'promotion_id' => 'required|exists:promotions,id',
        ]);

        $customer = Customer::findOrFail($request->customer_id);
        $promotion = Promotion::findOrFail($request->promotion_id);

        Mail::to($customer->email)->send(new PromotionMail($customer, $promotion));

        SendPromotion::create([
            'customer_id' => $customer->id,
            'promotion_id' => $promotion->id,
            'status' => 'sent',
            'sent_at' => now(),
        ]);

        return redirect()->route('send-promotions.index')->with('success', 'Promosi berhasil dikirim.');
    }

    public function show($id)
    {
        $sendPromotion = SendPromotion::with(['customer', 'promotion'])->findOrFail($id);
        return view('admin.send-promotions.show', compact('sendPromotion'));
    }

    public function edit($id)
    {
        $sendPromotion = SendPromotion::findOrFail($id);
        $customers = Customer::all();
        $promotions = Promotion::all();
        return view('admin.send-promotions.edit', compact('sendPromotion', 'customers', 'promotions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'promotion_id' => 'required|exists:promotions,id',
            'status' => 'required|in:sent,failed'
        ]);

        $sendPromotion = SendPromotion::findOrFail($id);
        $sendPromotion->update([
            'customer_id' => $request->customer_id,
            'promotion_id' => $request->promotion_id,
            'status' => $request->status
        ]);

        return redirect()->route('send-promotions.index')->with('success', 'Data pengiriman promosi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $sendPromotion = SendPromotion::findOrFail($id);
        $sendPromotion->delete();

        return redirect()->route('send-promotions.index')->with('success', 'Data pengiriman promosi berhasil dihapus.');
    }
}
