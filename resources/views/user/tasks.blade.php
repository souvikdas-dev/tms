<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between">
            <!-- header & subheader -->
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('User Tasks') }}
                </h2>
                <p class="text-sm">Here you can read all tasks</p>
            </div>

            <!-- actions -->
            <div class="flex self-end justify-between gap-2">
                <button type="button" class="text-indigo-700" onclick="fetchTasks()">Assign Task</button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="flex gap-3">
                <div class="border border-blue-400 rounded-md bg-gray-50">
                    <div class="bg-blue-400 py-1 px-2">User details</div>
                    <ul class="p-3">
                        <li>Name: {{ $user->name }}</li>
                        <li>Email: {{ $user->email }}</li>
                    </ul>
                </div>
                <div class="border border-green-400 rounded-md grow bg-gray-50">
                    <div class="bg-green-400 py-1 px-2">Tasks</div>
                    <ul class="p-3">
                        @foreach($tasks as $task)
                        <li>
                            {{ $task->title }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <!-- description dialog modal -->
    <dialog dialog-modal class="rounded-lg py-4 px-6 border shadow-md max-w-[20rem] md:max-w-[30rem] lg:max-w-[45rem] text-base transition-all duration-700 ease-in-out">
        <div dialog-modal-content class="font-light text-justify">
            <ul class="p-3" id="tasks">
            </ul>
        </div>

        <div dialog-modal-actions class="px-4 pt-3 text-right">
            <button type="button" dialog-modal-close class="px-1 py-0.5 font-medium text-indigo-800 rounded-sm">Done</button>
            <button type="button" dialog-modal-close class="px-1 py-0.5">Close</button>
        </div>
    </dialog>

    <script>
        const dialogModal = document.querySelector("dialog[dialog-modal]")
        dialogModal.querySelector("button[dialog-modal-close]").addEventListener('click', (event) => {
            dialogModal.close() // Opens a modal
        })

        const fetchTasks = () => {
            fetch("{{ route('gettasks') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(tasks => {
                    console.log(tasks)

                    let tasklist = '';

                    for (const task of tasks) {
                        tasklist += `
                            <li>
                                <input type="checkbox" name="task-${task.id}" id="task-${task.id}">
                                <span class="ml-1">${task.title}</span>
                            </li>
                        `;
                    }

                    dialogModal.querySelector("[dialog-modal-content]>#tasks").innerHTML = tasklist;
                    dialogModal.showModal() // Opens a modal
                })
        }
    </script>

</x-app-layout>