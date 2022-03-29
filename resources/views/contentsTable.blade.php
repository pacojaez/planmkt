<x-planmkt-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                @section('content')

                @livewire('content-table')

                @endsection
            </div>
        </div>
    </div>

    @push('scripts')
        <!-- JavaScript -->
        <script type="text/javascript">
            // Toasts a default alert
            function toastAlert() {
                var alertContent = "This is a default alert with <a href='#' class='alert-link'>a link</a> being toasted.";
                // Built-in function
                halfmoon.initStickyAlert({
                    content: alertContent, // Required, main content of the alert, type: string (can contain HTML)
                    title: "Default alert" // Optional, title of the alert, default: "", type: string
                })
            }

            // Toasts another alert (here, the options are shown)
            function toastAnotherAlert() {
                var alertContent = "This is another alert with <a href='#' class='alert-link'>a link</a> being toasted.";
                // Built-in function
                halfmoon.initStickyAlert({
                    content: alertContent, // Required, main content of the alert, type: string (can contain HTML)
                    title: "Another alert", // Optional, title of the alert, default: "", type: string
                    alertType: "", // Optional, type of the alert, default: "", must be "alert-primary" || "alert-success" || "alert-secondary" || "alert-danger"
                    fillType: "", // Optional, fill type of the alert, default: "", must be "filled-lm" || "filled-dm" || "filled"
                    hasDismissButton: true, // Optional, the alert will contain the close button if true, default: true, type: boolean
                    timeShown: 5000 // Optional, time the alert stays on the screen (in ms), default: 5000, type: number
                })
            }
        </script>
    @endpush
</x-planmkt-layout>
