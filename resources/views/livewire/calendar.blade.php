<div>
    <div class="absolute w-full p-2 mt-2">
        @if (session()->has('message'))
            <div class="p-2" id="alert-message">
                <div
                    class="inline-flex items-center p-2 text-base leading-none text-green-400 bg-white rounded-full drop-shadow-2xl text-teal">
                    <span class="inline-flex items-center justify-center h-6 px-3 text-white bg-green-600 rounded-full">
                        {{ session('message') }}
                    </span>
                </div>
            </div>
        @endif
    </div>
    <style>
        .ghost {
            opacity: 0.4;
            background-color: red;
        }

        .my-handle {
            cursor: move;
            cursor: -webkit-grabbing;
        }

    </style>
    <div class="w-full h-full container-fluid justify-content-start">
        <div class="row d-flex justify-content-start">
            <!-- generamos un div draggable para clonar por cada empleado -->
            <div class="py-5 mx-5 text-center bg-gray-300 d-flex flex-column">
                <span class="font-bold">CONTENIDOS:</span>
                @foreach ($empleados as $empleado)
                    <div class="flex flex-col py-5 mx-5 border rounded" id="Empleado_{{ $empleado['id'] }}">
                        <div class="flex flex-row justify-between py-5 mx-5 my-10 text-sm align-center"
                            id="{{ $empleado['empleado'] }}">
                            <span class="py-5 mx-5 my-handle">::</span>
                            <p class="py-5 mx-5 font-bold cursor-pointer text-primary">{{ $empleado['rs'] }}
                                {{ $empleado['content'] }}
                            </p>
                            <span
                                {{-- onclick="removeItem(event, {{ $status['title'] . '_' . $turno['title'] }} )" --}}
                                {{-- id="remove_{{ $record['title'] }}" --}}
                                class="py-5 my-5 font-bold cursor-pointer d-none text-danger">
                                X
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- generamos un div para cada dia de la semana -->
            <div class="py-5 mx-5 my-5 bg-ligth d-flex justify-content-start">
                @foreach ($statuses as $status)
                    <div class="flex-wrap h-full py-5 mx-5 my-5 text-center border d-flex flex-column justify-content-start text-dark bg-light"
                        wire:model="records">
                        <span class="m-2 font-bold">{{ $status['title'] }}</span>
                        <div id="{{ $status['title'] }}"
                            @if ($recordClickEnabled) wire:click="onRecordClick('{{ $record['id'] }}')" @endif
                            class="w-full py-5 mx-5 my-5 border rounded shadow d-flex flex-column">
                            <!-- generamos un div droppable para cada turno -->
                            @foreach ($turnos as $turno)
                                <div id="{{ $status['title'] }}_{{ $turno['title'] }}" data-empleados=""
                                    @if ($recordClickEnabled) wire:click="onRecordClick('{{ $record['id'] }}')" @endif
                                    class="px-5 mx-5 border rounded shadow border-dark d-flex flex-column bg-light">
                                    <span class="text-dark">{{ $turno['title'] }}</span>
                                </div>
                                @foreach ($records as $index => $record)
                                    <div wire:key="{{ $record->id }}">
                                        @if ($record->status == $status['title'] . '_' . $turno['title'])
                                            <div class="h-full py-5 mx-5 my-5 border rounded container-fluid"
                                                id="{{ $record->title }}">
                                                <div class="p-5 text-sm text-gray-200 shadow-lg col d-flex justify-content-between"
                                                    data-empleado="{{ $record['title'] }}">
                                                    <p class="p-5 mx-5">
                                                        {{ $record->title }}
                                                    </p>
                                                    <span
                                                        onclick="removeItem(event, {{ $status['title'] . '_' . $turno['title'] }} )"
                                                        ) id="remove_{{ $record['title'] }}"
                                                        class="py-5 my-5 font-bold cursor-pointer text-danger">
                                                        X
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <div>
        <script>
            window.onload = () => {
                @foreach ($empleados as $empleado)
                    // creamos un elemento draggable por cada empleado
                    // vinculado a los elementos droppables de la lista de la semana con el group
                    Sortable.create(document.getElementById('Empleado_{{ $empleado['id'] }}'), {
                        group: {
                        name: 'shared',
                        pull: 'clone',
                        put: false,
                        animation: 100,
                        ghostClass: 'bg-indigo-100',
                        swap: true, // Enable swap plugin
                        swapClass: 'font-bold', // The class applied to the hovered swap item
                        animation: 150,
                        swapThreshold: 0,
                        sort: false,
                        handle: '.handle', // handle's class
                        },
                        // setData: function (dataTransfer, dragEl) {
                        // dataTransfer.setData('id', dragEl.id);
                        // },
                        // al seleccionar el elemento le añadimos una clase para diferenciarlo del resto de elementos del DOM
                        onChoose: function (/**Event*/evt) {
                        evt.oldIndex; // element index within parent
                        // console.log(evt.item.parentElement);
                        evt.item.classList.add('text-danger');
                            },
                        // al finalizar el drag le quitamos el cursor-pointer
                        // y llamamos a la funcion de Livewire para qeu nos lo añada a la DB
                        onEnd: function (evt) {
                        evt.preventDefault();
                        evt.item.classList.remove('cursor-pointer');
                        evt.item.classList.remove('text-danger');
                        evt.item.classList.add('bg-success');
                        evt.item.parentElement.classList.add('font-weight-bold')
                        let parentId = evt.item.parentElement.id;
                        // this.added;
                        console.log('Ev: '+ evt.to.id);
                        @this.call('onStatusChanged', evt.to.id, evt.item.id );

                        }
                    });
                @endforeach

                @foreach ($statuses as $status)
                    @foreach ($turnos as $turno)
                        Sortable.create(document.getElementById('{{ $status['title'] }}_{{ $turno['title'] }}'), {
                        ghostClass: "bg-gray-400",
                        group: {
                        name: 'shared',
                        put: true,
                        pull: false,
                        animation: 100,
                        // ghostClass: 'bg-indigo-100',
                        swapThreshold: 0,
                        sort: true,
                        },
                        setData: function (dataTransfer, dragEl) {
                        dataTransfer.setData('id', dragEl.id);
                        },
                        onEnd: function (evt) {
                        evt.preventDefault();
                        @this.call('onStatusChanged', evt.to.id, evt.item.id );
                        // console.log('Evt: ' + dragEl.id);
                        }
                        });
                    @endforeach
                @endforeach

                let added = () => {
                    // creamos una constante para eliminar el mensaje de alerta de la session a los tres segundos
                    const alert = document.getElementById('alert-message');

                    setTimeout(() => {
                        alert.classList.add('hidden');
                    }, 2000);
                }

            }

            // creamos una constante para pasarle a la funcion removeFromDB de Livewire
            // pasandole los datos del turno y el empleado
            const removeItem = (event, turno) => {
                let e = event.target.parentElement;
                @this.call('removeFromDB', turno.id, e.getAttribute("data-empleado"));
            }
        </script>
    </div>
</div>
