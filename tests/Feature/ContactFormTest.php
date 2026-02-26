<?php

namespace Tests\Feature;

use App\Mail\ContactMessageMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_saves_message_and_sends_mail_with_reply_to(): void
    {
        Mail::fake();
        $this->withoutMiddleware();

        $payload = [
            'name' => 'Jan Test',
            'email' => 'jan@example.com',
            'message' => 'Test contact message.',
        ];

        $response = $this->post(route('contact.store'), $payload);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contacts', [
            'email' => 'jan@example.com',
            'message' => 'Test contact message.',
        ]);

        Mail::assertSent(ContactMessageMail::class, function (ContactMessageMail $mail) {
            return $mail->email === 'jan@example.com'
                && $mail->name === 'Jan Test'
                && $mail->userMessage === 'Test contact message.';
        });
    }

    public function test_contact_form_requires_all_fields(): void
    {
        $this->withoutMiddleware();

        $response = $this->from(route('kontakt'))->post(route('contact.store'), []);

        $response->assertRedirect(route('kontakt'));
        $response->assertSessionHasErrors(['name', 'email', 'message']);
    }
}
