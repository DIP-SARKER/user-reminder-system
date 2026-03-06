<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">
                        Welcome, {{ auth()->user()->name }} 👋
                    </h3>

                    <p class="mt-2 text-gray-600">
                        Glad to see you back! You are successfully logged in.
                    </p>
                </div>
            </div>
            @php
                $reminders = auth()->user()->reminderLogs()->latest('sent_at')->get();
            @endphp

            @if ($reminders->isNotEmpty())

                <table class="w-full text-sm mt-3">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2">Reminder Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reminders as $reminder)
                            <tr class="border-b">
                                <td class="py-2">
                                    {{ $reminder->sent_at->format('Y-m-d H:i') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
