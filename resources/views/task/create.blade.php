<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">

                <!-- main content -->
                <div class="p-2">

                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        <x-forms.input name='title' placeholder='Enter the title here' required autofocus="autofocus" autocomplete="title" />
                        <x-forms.input name='description' required />
                        <x-forms.input type='date' name='due_date' required />

                        <button type="submit" class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>