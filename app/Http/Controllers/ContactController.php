<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Mail\ContactMessageMail;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(StoreContactRequest $request)
    {
        $validated = $request->validated();

        Contact::create($validated);

        $destinationEmail = config('mail.destination_address', config('mail.from.address'));

        Mail::to($destinationEmail)->send(
            new ContactMessageMail(
                $validated['name'],
                $validated['email'],
                $validated['message']
            )
        );

        return back()->with('success', 'Dziekujemy za wiadomosc.');
    }
}
