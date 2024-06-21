@props(['name', 'required' => false, 'type' => 'text'])
<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 capitalize">
        {{ join(" ", explode("_", $name)) }}

        @if($required)
        <span class="text-red-500">*</span>
        @endif
    </label>
    <input id="{{ $name }}" type="{{ $type }}" name="{{ $name }}" {{ $required ? 'required' : '' }} {{ $attributes->merge(['class'=>"block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"]) }} />
</div>