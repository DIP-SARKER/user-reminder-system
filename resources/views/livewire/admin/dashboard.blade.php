<div class="p-6">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-5 text-gray-900 bg-white shadow rounded-lg border border-gray-100">
            <h3 class="text-lg font-semibold">
                Welcome, {{ auth()->user()->name }} 👋
            </h3>

            <p class="mt-2 text-gray-600">
                Glad to see you back! You are successfully logged in.
            </p>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                @forelse ($users as $user)
                    @php
                        $lastReminder = $user->reminderLogs->sortByDesc('sent_at')->first();
                    @endphp

                    <div class="p-5 bg-white shadow rounded-lg border border-gray-100">
                        <div class="space-y-2">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">
                                    {{ $user->name }}
                                </h3>
                                <p class="text-sm text-gray-500">
                                    {{ $user->email }}
                                </p>
                            </div>

                            <div class="border-t pt-3 space-y-2 text-sm text-gray-700">
                                <p>
                                    <span class="font-medium">Admin:</span>
                                    @if ($user->is_admin)
                                        <span class="text-green-600 font-semibold">Yes</span>
                                    @else
                                        <span class="text-gray-500">No</span>
                                    @endif
                                </p>

                                <p>
                                    <span class="font-medium">Last logged in:</span>
                                    @if ($user->last_login_at)
                                        {{ \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() }}
                                    @else
                                        <span class="text-gray-400">Never</span>
                                    @endif
                                </p>

                                <p>
                                    <span class="font-medium">Reminder sent:</span>
                                    @if ($lastReminder && $lastReminder->sent_at)
                                        @php
                                            $sentAt = \Carbon\Carbon::parse($lastReminder->sent_at);
                                            $isOld = $sentAt->lt(now()->subDays(7));
                                        @endphp

                                        <span class="{{ $isOld ? 'text-red-600' : 'text-green-600' }}">
                                            {{ $sentAt->diffForHumans() }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">None</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full p-6 bg-white shadow rounded-lg text-gray-500">
                        No users found.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
