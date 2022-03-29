<x-planmkt-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Board') }}
        </h2>
    </x-slot>
    @section('content')
        @livewire('calendar')
    @endsection

</x-planmkt-layout>
