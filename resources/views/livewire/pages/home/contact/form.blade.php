<div>
    @if ($isEmailSent == false)
        <div class="bg-zinc-900 md:bg-gradient-to-r md:from-zinc-950 md:via-zinc-700 md:via-70% md:to-zinc-950 shadow-xl p-6 rounded-xl">
            <form wire:submit="sendMessage" class="space-y-6">
                <x-custom.form-input wire:model="name" name="name" title="Nombre" />

                <x-custom.form-input wire:model="email" name="email" title="Correo electrónico" type="email" />

                <x-custom.form-textarea wire:model.live="message" name="message" title="Mensaje" rows="6" maxlength="500">
                    @if ($message)
                        <i class="text-zinc-300 text-xs ml-1">Restan {{ 500 - strlen($message) }} de 500 caracteres</i>
                    @endif
                </x-custom.form-textarea>

                <div class="flex justify-end">
                    <x-custom.form-button-primary type="submit">Enviar</x-custom.form-button-primary>
                </div>
            </form>
        </div>
    @else
        <div class="bg-zinc-900/90 shadow-xl p-8 rounded-lg text-center">
            <h1 class="text-2xl text-center text-zinc-300">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-8 h-8 mr-2 text-sky-500 inline-block align-middle">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span class="inline-block align-middle">Mensaje enviado</span>
            </h1>
            <p class="text-white my-8">
                He recibido su mensaje, me contactaré a la brevedad.
            </p>
            <x-custom.form-button-highlight wire:click="newMessage" type="buttons">Redactar otro mensaje</x-custom.form-button-highlight>
            {{-- <button type="button" wire:click="newMessage" class="inline-flex items-center py-2 px-6 mr-2 text-xs font-semibold rounded border border-transparent text-white uppercase transition bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700">
                Redactar otro mensaje
            </button> --}}
        </div>
    @endif
</div>