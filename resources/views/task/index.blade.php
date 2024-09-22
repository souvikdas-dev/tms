<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between">
            <!-- header & subheader -->
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Tasks') }}
                </h2>
                <p class="text-sm">Here you can read all tasks</p>
            </div>

            <!-- actions -->
            <div class="flex self-end justify-between gap-2">
                <a href="{{ route('tasks.create') }}" class="px-3 font-medium uppercase bg-green-500 rounded shadow hover:bg-green-300">+ Add</a>
            </div>
        </div>




    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 rtl:text-right">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    SN.
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Title
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Due Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Priority
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    status
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $index => $task)
                            <tr class="border-b odd:bg-white even:bg-gray-50">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $tasks->firstItem() + $index }}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $task->title }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $task->description }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $task->due_date->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $task->priority }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $task->status }}
                                </td>
                                <td class="px-6 py-4">

                                    <div class="inline-flex gap-2">
                                        <a href='{{ url("/tasks/{$task->id}/edit") }}' class="font-medium text-blue-600 hover:underline">Edit</a>

                                    <form action='{{ url("/tasks/{$task->id}") }}' method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="font-medium text-red-600 hover:underline">Delete {{ $task->id }}</button>
                                    </form>
                                    </div>
                                        
                                    <p class="text-gray-600 text-xs">
                                        {{ $task->updated_at->diffForHumans(); }}
                                    </p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3">
                {{ $tasks->onEachSide(2)->links() }}
            </div>
        </div>
    </div>

</x-app-layout>