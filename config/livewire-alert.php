<?php

/*
 * For more details about the configuration, see:
 * https://sweetalert2.github.io/#configuration
 */
return [
    'alert' => [
        'position' => 'top-end',
        'timer' => 3000,
        'toast' => true,
        'text' => null,
        'showCancelButton' => false,
        'showConfirmButton' => false
    ],
    'confirm' => [
        'icon' => 'question',
        'iconColor' => '#ef4444',
        'position' => 'center',
        'toast' => false,
        'timer' => null,
        'showConfirmButton' => true,
        'showCancelButton' => true,
        'cancelButtonText' => 'Cancel',
        'buttonsStyling' => false,
        'customClass' => [
            'title' => 'text-xl',
            'confirmButton' => 'bg-red-600 inline-flex items-center py-2 px-4 mr-2 text-xs font-semibold rounded-md border border-transparent text-white uppercase tracking-widest hover:bg-red-500 transition',
            'cancelButton' => 'inline-flex items-center py-2 px-4 text-xs rounded-md border border-gray-300 font-semibold text-gray-700 uppercase tracking-widest bg-white hover:bg-gray-50 transition',
        ],
    ],
];
