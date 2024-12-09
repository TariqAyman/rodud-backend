<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Messages Order') }} #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Send message to User') }}
                            </h2>
                        </header>

                        <form method="post"
                              action="{{ route('admin.messages.store',['order' => $order]) }}"
                              class="mt-6 space-y-6">
                            @csrf
                            <div>
                                <x-input-label for="message" :value="__('Message')"/>
                                <x-text-input id="message" name="message" type="text" class="mt-1 block w-full"
                                              required autofocus/>
                            </div>
                            <x-primary-button>{{ __('Send') }}</x-primary-button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Admin
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Message
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($messages as $message)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $message->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $message->admin->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $message->message }}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $messages->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
