<x-dropdown align="right" width="48">
    <x-slot name="trigger">
        <button type="button"
                class="relative mx-5 flex-shrink-0 rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
            </svg>
            <span class="sr-only">View notifications</span>
            @if($unreadNotifications->count() > 0)
                @foreach($unreadNotifications as $notification)
                        <div
                            class="absolute inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500  rounded-full -top-1 -end-1 dark:border-gray-900">
                            {{ ($unreadNotifications->count() < 10 )? $unreadNotifications->count() : '9+' }}
                        </div>
                @endforeach
            @endif
        </button>
    </x-slot>

    <x-slot name="content">
        @forelse($unreadNotifications as $notification)
            <!-- Mark notification as read -->
            <form method="POST" action="{{ route('notifications.mark', $notification->id) }}">
                @csrf
                @method('PATCH')
                <x-dropdown-link :href="route('notifications.mark', $notification->id)"
                                       class="truncate"
                                       title="{{ $notification->data['message'] }}"
                                       onclick="event.preventDefault();
                                            this.closest('form').submit();">
                    {{ $notification->data['message'] }}
                </x-dropdown-link>
            </form>
        @empty
            <div class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 transition duration-150 ease-in-out">
                {{ __('No new notifications') }}
            </div>
        @endforelse
    </x-slot>
</x-dropdown>
