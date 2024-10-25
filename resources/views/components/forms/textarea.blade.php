@props(['name', 'value' => '', 'required' => false])
<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 capitalize">
        {{ join(" ", explode("_", $name)) }}

        @if($required)
        <span class="text-red-500">*</span>
        @endif
    </label>
    <textarea id="{{ $name }}" name="{{ $name }}" {{ $required ? 'required' : '' }} {{ $attributes->merge(['rows'=>'4', 'class'=>"block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"]) }}>{!! $value !!}</textarea>
</div>