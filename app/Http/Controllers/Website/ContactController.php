<?php

namespace App\Http\Controllers\Website;

use App\Codes\Models\Contact;
use App\Codes\Models\Settings;
use App\Codes\Logic\WebController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class ContactController extends WebController
{
    protected $data;
    protected $request;

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function index()
    {
        $data = $this->data;

        if (!isset($data['page']['homepage'])) {
            return redirect()->route('404');
        }

        return view(env('WEBSITE_TEMPLATE') . '.page.contact', $data);
    }

    public function postContact()
    {
        $data = $this->validate($this->request, [
            'g-recaptcha-response' => 'required|captcha',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|regex:/(0)[0-9]/',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $contact = Contact::create([
            'name' => $data['name'] ?? null,
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'subject' => $data['subject'] ?? null,
            'message' => $data['message'] ?? null,
            'status' => 1,
        ]);

        $settings = Cache::remember('settings', env('SESSION_LIFETIME'), function () {
            return Settings::pluck('value', 'key')->toArray();
        });

        $subject = $contact->subject;
        $recipient = $settings['contact-email'] ?? 'contact@vmldigitalsolution.com';

        Mail::send('mail.forgot', [
            'contact' => $contact,
            'email' => $contact->email,
        ], function ($m) use ($contact, $subject, $settings, $recipient) {
            $m->to($recipient, 'Admin')->subject($subject);
        });

        session()->flash('message', __('general.success_send_', ['field' => __('general.email')]));
        session()->flash('message_alert', 2);
        return redirect()->route('contact');
    }
}
