<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                @isset($user)
                                    {{ __('Notify user: ') }} <span
                                            class="font-bold text-indigo-600">{{ $user->name }}</span>
                                @else
                                    <span class="font-bold text-indigo-600">{{ __('Notify all users') }}</span>
                                    <div class="text-sm text-gray-600">
                                        {{ __('If you want to notify a specific user navigate here: ') }} <a class="text-indigo-600 hover:text-indigo-400"
                                                href="{{ route('users.index') }}">{{ __('users list') }}</a>
                                    </div>
                                @endisset
                            </h2>
                        </header>

                        <form method="post" action="{{ route('notifications.store', ['user' => $user ?? null
                        ]) }}" class="mt-6 space-y-6">
                            @csrf

                            <input type="hidden" name="method" value="{{ $user ? 'specific': 'all' }}">
                            <div>
                                <x-input-label for="type" :value="__('Type')"/>
                                <select id="type" name="type"
                                        class="mt-2 block w-full rounded-md border-0 py-2 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <option>Marketing</option>
                                    <option>Invoices</option>
                                    <option selected>System</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="expiry_date" :value="__('Expiration Date')"/>
                                <div class="mt-2 relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                        </svg>
                                    </div>
                                    <input name="expiry_date" id="expiry_date" datepicker datepicker-autohide
                                           datepicker-autoselect-today
                                           type="text"
                                           class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           placeholder="Select date">
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('expiry_date')"/>
                            </div>

                            <div>
                                <x-input-label for="message" :value="__('Message')"/>
                                <div class="mt-2">
                                    <textarea rows="4" name="message" id="message"
                                              class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('message')"/>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </div>
                        </form>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
