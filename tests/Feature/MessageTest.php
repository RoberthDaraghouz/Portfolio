<?php

namespace Tests\Feature;

use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Volt\Volt;
use Tests\TestCase;

class MessageTest extends TestCase{
    public function test_home_contact_page_and_dashboard_messages_page_are_displayed(): void{
        $this->get('/')
            ->assertOk()
            ->assertSee('pages.home.contact');
    }

    public function test_message_can_be_created_at_contact_page(): void {
        $component = Volt::test('pages.home.contact')
            ->set('name', 'Test customer send test message')
            ->set('email', 'customer@domain.com')
            ->set('message', 'Test message')
            ->call('sendMessage')
            ->assertHasNoErrors();
        
        $message = Message::where('name', 'Test customer send test message')->first();

        $this->assertSame('Test customer send test message', $message->name);
    }

    public function test_message_cannot_be_created_empty_at_contact_page(): void {
        $component = Volt::test('pages.home.contact')
            ->set('name', '')
            ->set('email', '')
            ->set('message', '')
            ->call('sendMessage')
            ->assertHasErrors();
    }

    public function test_messages_can_be_showed_at_dashboard(): void {
        $message = Message::factory()->create();

        Volt::test('admin.dashboard.messages.index')
            ->assertSee($message->name);
    }

    public function test_messages_can_be_update_status_at_dashboard(): void {
        $message = Message::factory()->create();

        Volt::test('admin.dashboard.messages.status', ['message' => $message])
            ->call('changeStatus')
            ->assertHasNoErrors();
        
        $message->refresh();

        $this->assertSame('read', $message->status);
    }

    public function test_message_can_be_deleted(): void {
        $message = Message::create([
            'name' => 'Test name to delete',
            'email' => 'test@domain.com',
            'message' => 'Message test',
        ]);

        Volt::test('admin.dashboard.messages.delete', ['message' => $message])
            ->call('destroy')
            ->assertHasNoErrors();
        
        $this->assertDatabaseMissing('messages', $message->toArray());
    }
}