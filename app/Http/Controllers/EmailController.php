<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\Customer;
use App\Models\Promotion;
use App\Models\SendPromotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendPromotionEmails()
    {
        $customers = Customer::all();
        $activePromotions = Promotion::where('is_active', 1)->get();

        foreach ($customers as $customer) {
            foreach ($activePromotions as $promotion) {
                try {
                    // Kirim email promosi ke customer
                    Mail::to($customer->email)
                        ->send(new TestMail(
                            $promotion->description,
                            $promotion->title,
                            'Promosi Khusus untuk Anda'
                        ));

                    // Catat pengiriman promosi
                    SendPromotion::sendPromotion($customer->id, $promotion->id);

                } catch (\Exception $e) {
                    // Catat kegagalan pengiriman
                    SendPromotion::create([
                        'customer_id' => $customer->id,
                        'promotion_id' => $promotion->id,
                        'status' => 'failed',
                        'sent_at' => now()
                    ]);
                    
                    continue;
                }
            }
        }

        return 'Email promosi berhasil dikirim ke semua customer';
    }
}
