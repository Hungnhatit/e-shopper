<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\MailNotify;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index(Request $request)
    {
        if (session('cart')) {
            $cart = session()->get('cart', []);
        }
        $data = [
            'username' => $request->username,
            'address' => $request->address,
            'product' => $cart
        ];
        $adminEmail = 'hungnhat.spkt@gmail.com';
        Mail::mailer('smtp')->to($adminEmail)
            ->send(new MailNotify($data));
        $request->session()->put('thongbao', 'Email xác nhận đã được gửi');
        return redirect('/notify');
        
    }

    public function notify(Request $request)
    {
        $tb = $request->session()->get('thongbao');
        return view('frontend.mail.notify', ['thongbao' => $tb]);
    }
}
