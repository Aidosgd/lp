<?php

namespace App\Http\Controllers;

use App\Callback;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use Mail;

class MailController extends Controller
{
    public function callbacks(Request $request, Mailer $mailer)
    {
//        $emails = ['denisov_sv@mail.ru', 'manager141214@mail.ru', 'gorbenko_oleg@mail.ru','aidosgd@gmail.com'];
//        $mailer->send('emails.mail', ['name' => $request->input('name'), 'phone' => $request->input('phone')], function ($m) use ($emails) {
//            $m->from('info@russdoors.kz', 'Заявка с сайта Russdoors');
//            $m->to($emails, 'Aidos')->subject('Заявка с сайта Russdoors');
//        });

        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
        ]);

        $calls = new Callback;

        $calls->fill($request->input());

        $calls->save();

        return redirect('/')->with('message', 'Письмо отправили!');
    }

    public function orders(Request $request, Mailer $mailer)
    {
//        $emails = ['denisov_sv@mail.ru', 'manager141214@mail.ru', 'gorbenko_oleg@mail.ru','aidosgd@gmail.com'];
//        $mailer->send('emails.mail', ['name' => $request->input('name'), 'phone' => $request->input('phone')], function ($m) use ($emails) {
//            $m->from('info@russdoors.kz', 'Заявка с сайта Russdoors');
//            $m->to($emails, 'Aidos')->subject('Заявка с сайта Russdoors');
//        });

        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
        ]);

        $order = new Order;

        $order->fill($request->input());

        $order->save();

        return redirect('/')->with('message', 'Письмо отправили!');
    }
}
