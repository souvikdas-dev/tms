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

                    <form action="">

                        <x-forms.input name='title' placeholder='Enter the title here' required autofocus="autofocus" autocomplete="title"/>
                        <x-forms.input name='description'/>
                        <x-forms.input type='date' name='due_date'/>
                        <x-forms.input name='priority'/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>