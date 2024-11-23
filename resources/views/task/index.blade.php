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


            @session('alert')
            <x-alert type="{{ $value['type'] }}" title="{{ $value['title']??'' }}" message="{{ $value['message'] }}" />
            @endsession

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
                            @forelse($tasks as $index => $task)
                            <tr class="border-b odd:bg-white even:bg-gray-50">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $tasks->firstItem() + $index }}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $task->title }}
                                </th>
                                <td class="px-6 py-4">
                                    <span class="cursor-pointer hover:text-blue-600" onclick="showTaskDescription(`{!! $task->description !!}`)">
                                        {{ str()->words($task->description, 6, ' ...') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $task->due_date->format("d M, Y h:i A") }}
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
                                        <button type="button" onclick="deleteTask('{{ $task->id }}')" class="font-medium text-red-600 hover:underline">Delete</button>

                                        {{--
                                        <form action='{{ url("/tasks/{$task->id}") }}' method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="font-medium text-red-600 hover:underline">Delete {{ $task->id }}</button>
                                        </form>
                                        --}}
                                    </div>

                                    <p class="text-xs text-gray-600">
                                        {{ $task->updated_at->diffForHumans(); }}
                                    </p>
                                </td>
                            </tr>
                            @empty
                            <tr class="border-b odd:bg-white even:bg-gray-50">
                                <td colspan="7" class="px-5 py-12 text-center border">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block w-6 me-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                    </svg>

                                    No Records Found!
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3">
                {{ $tasks->onEachSide(2)->links() }}
            </div>
        </div>
    </div>

    <!-- description dialog modal -->
    <dialog dialog-modal class="rounded-lg py-4 px-6 border shadow-md max-w-[20rem] md:max-w-[30rem] lg:max-w-[45rem] text-base transition-all duration-700 ease-in-out">
        <p dialog-modal-content class="font-light text-justify">
        </p>

        <div dialog-modal-actions class="px-4 pt-3 text-right">

            <button type="button" dialog-modal-close class="px-1 py-0.5">Close</button>
        </div>
    </dialog>

    <script>
        const deleteTask = (task_id) => {
            console.log(`taskid": ${task_id}`);

            if (confirm("Are you sure you want to delete!")) {

                const form = document.createElement("form");
                form.method = "POST";
                form.action = `/tasks/${task_id}`;

                const input_token = document.createElement("input");
                input_token.type = "hidden";
                input_token.name = "_token";
                input_token.value = "{{ csrf_token() }}";

                const input_method = document.createElement("input");
                input_method.type = "hidden";
                input_method.name = "_method";
                input_method.value = "DELETE";

                form.appendChild(input_method);
                form.appendChild(input_token);

                document.body.appendChild(form);

                // Trigger form submission
                form.submit();
            }
        }

        const dialogModal = document.querySelector("dialog[dialog-modal]")
        dialogModal.querySelector("button[dialog-modal-close]").addEventListener('click', (event) => {
            dialogModal.close() // Opens a modal
        })

        const showTaskDescription = (description) => {

            dialogModal.querySelector("[dialog-modal-content]").textContent = description;

            dialogModal.showModal() // Opens a modal
        }
    </script>

</x-app-layout>