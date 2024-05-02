<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Users</h1>
            <p class="mt-2 text-sm text-gray-700">A list of all the users including their name, email, phone,
                notification settings and notifications count.</p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <!-- Search form -->
            <div class="group relative mt-2 rounded-md shadow-sm">
                <input type="search" name="search"
                       class="block w-full rounded-md border-0 py-1.5 pl-10 text-gray-600 ring-1 ring-inset ring-indigo-400 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                       placeholder="{!! __('Search') !!}" wire:model.live="query">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <button class="absolute inset-0 right-auto group" type="submit"
                            aria-label="Search">
                        <svg
                            class="w-4 h-4 shrink-0 fill-current text-indigo-400 dark:text-indigo-600 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 ml-4 mr-2"
                            viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z"/>
                            <path
                                d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="-mx-4 mt-8 sm:-mx-0">
        <table class="min-w-full divide-y divide-gray-300">
            <thead>
            <tr>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Name</th>
                <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                    Phone
                </th>
                <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                    Email
                </th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Notification</th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Unread</th>
                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
            @forelse ($users as $user)
                <tr>
                    <td class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-0">
                        {{ $user->name }}
                        <dl class="font-normal lg:hidden">
                            <dt class="sr-only">Phone</dt>
                            <dd class="mt-1 truncate text-gray-700">{{ $user->phone }}</dd>
                            <dt class="sr-only sm:hidden">Email</dt>
                            <dt class="sr-only sm:hidden">Unread</dt>
                            <dd class="mt-1 truncate text-gray-500 sm:hidden">{{ $user->email }}</dd>
                        </dl>
                    </td>
                    <td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell">{{ $user->phone }}</td>
                    <td class="hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">{{ $user->email }}</td>
                    <td class="px-3 py-4 text-sm text-gray-500">
                        @if($user->notification)
                            <div class="mt-1 flex items-center gap-x-1.5">
                                <div class="flex-none rounded-full bg-emerald-500/20 p-1">
                                    <div class="h-1.5 w-1.5 rounded-full bg-emerald-500"></div>
                                </div>
                                <p class="text-xs leading-5 text-green-500">On</p>
                            </div>
                        @else
                            <div class="mt-1 flex items-center gap-x-1.5">
                                <div class="flex-none rounded-full bg-red-500/20 p-1">
                                    <div class="h-1.5 w-1.5 rounded-full bg-red-500"></div>
                                </div>
                                <p class="text-xs leading-5 text-red-500">Off</p>
                            </div>
                        @endif
                    </td>
                    <td class="hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">{{ $user->unreadNotifications->count() }}</td>
                    <td class="px-3 py-4 text-sm text-gray-500 sm:table-cell">
                        <!-- Settings Dropdown -->
                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button type="button"
                                            class="flex items-center border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                            id="options-menu-0-button" aria-expanded="false" aria-haspopup="true">
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z"/>
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Impersonate') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Message') }}
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-0">
                        {{ __('No users found.') }}
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</div>
