<?php

use App\Models\Message;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new class extends Component {
    #[Validate('required', message: 'El campo nombre es requerido.')]
    #[Validate('max:80', message: 'El campo nombre no puede ser mayor a 80 caracteres.')]
    public string $name;
    #[Validate('required', message: 'El campo correo electrónico es requerido.')]
    #[Validate('email', message: 'El campo correo electrónico debe ser una dirección de correo electrónico válida.')]
    #[Validate('max:190', message: 'El campo correo electrónico no puede ser mayor a 190 caracteres.')]
    public string $email;
    #[Validate('required', message: 'El campo mensaje es requerido.')]
    #[Validate('max:500', message: 'El campo mensaje no puede ser mayor a 500 caracteres.')]
    public string $message;

    public $isEmailSent = false;

    public function sendMessage():void {
        $this->validate();

        Message::create([
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ]);

        $this->name = '';
        $this->email = '';
        $this->message = '';

        $this->isEmailSent = true;
    }

    public function newMessage(){
        $this->isEmailSent = false;
    }
}; ?>

<section class="min-h-screen flex justify-center bg-gradient-to-r from-zinc-950 from-10% via-sky-600 to-sky-500 px-4 py-4">
    <div class="w-full md:max-w-5xl xl:max-w-7xl z-10">
        <h1 class="text-7xl md:text-8xl md:text-center lg:text-left bg-clip-text text-transparent bg-gradient-to-r from-sky-500 to-50% to-sky-300">
            Contacto
        </h1>

        <div class="grid grid-cols-1 lg:grid lg:grid-cols-2 gap-6 py-4 lg:mt-6">
            @include('livewire.pages.home.contact.info')
            @include('livewire.pages.home.contact.form')
        </div>
    </div>
</section>