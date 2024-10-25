@props(['type'])

@php
$color = 'text-blue-800 bg-blue-50';
if($type == 'success'){
$color = 'text-green-800 bg-green-50';
}
elseif($type == 'error'){
$color = 'text-red-800 bg-red-50';
}
elseif($type == 'warning'){
$color = 'text-yellow-800 bg-yellow-50';
}
@endphp


<div class="flex items-center p-4 mb-4 text-sm rounded-lg {{ $color }}" role="alert">
    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
    </svg>
    <span class="sr-only">{{ $type }}</span>
    <div>
        <span class="font-medium">Success alert! - type: {{ $type }}</span> Change a few things up and try submitting again.
    </div>
</div>