<?php

namespace App\Http\Controllers;

use App\Callback;
use App\Order;
use App\Subs;
use Ibec\Subscription\Subscription;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use Mail;

class MailController extends Controller
{
    public function callbacks(Request $request, Mailer $mailer)
    {
        $emails = ['vlasovmaxim96@gmail.com', 'aidosgd@gmail.com'];
        $mailer->send('emails.mail', ['name' => $request->input('name'), 'phone' => $request->input('phone')], function ($m) use ($emails) {
            $m->from('info@perspectiva-lombard.kz', 'Заявка на звонок');
            $m->to($emails, 'Aidos')->subject('Заявка на звонок');
        });

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
        $emails = ['vlasovmaxim96@gmail.com', 'aidosgd@gmail.com'];
        $mailer->send('emails.mail', ['name' => $request->input('name'), 'phone' => $request->input('phone')], function ($m) use ($emails) {
            $m->from('info@perspectiva-lombard.kz', 'Заявка на товар');
            $m->to($emails, 'Aidos')->subject('Заявка на товар');
        });

        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
        ]);

        $order = new Order;

        $order->fill($request->input());

        $order->save();

        return redirect('/')->with('message', 'Письмо отправили!');
    }

    public function subscribers(Request $request, Mailer $mailer)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:subs',
        ]);

        $order = new Subs;

        $order->fill($request->input());

        $order->save();

        $emails = ['aidosgd@gmail.com'];
        $mailer->send('emails.subs', ['email' => $request->input('email')], function ($m) use ($emails) {
            $m->from('info@perspectiva-lombard.kz', 'Заявка на товар');
            $m->to($emails, 'Aidos')->subject('Новый подписчик');
        });

        return redirect('/')->with('message', 'Письмо отправили!');
    }
}
