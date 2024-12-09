<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order') }} #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Order Information') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Update order status") }}
                            </p>
                        </header>
                        <div>
                            <div>
                                <x-input-label for="item" :value="__('Item')"/>
                                <x-text-input id="item" name="item" type="text" class="mt-1 block w-full"
                                              :value="$order->item" required autofocus disabled/>
                            </div>

                            <div>
                                <x-input-label for="size" :value="__('Size')"/>
                                <x-text-input id="size" name="size" type="text" class="mt-1 block w-full"
                                              :value="$order->size" required autofocus disabled/>
                            </div>

                            <div>
                                <x-input-label for="weight" :value="__('Weight')"/>
                                <x-text-input id="weight" name="weight" type="text" class="mt-1 block w-full"
                                              :value="$order->weight" required autofocus disabled/>
                            </div>

                            <div>
                                <x-input-label for="pickup_at" :value="__('Pickup At')"/>
                                <x-text-input id="pickup_at" name="pickup_at" type="text"
                                              class="mt-1 block w-full"
                                              :value="$order->pickup_at" required autofocus disabled/>
                            </div>

                            <div>
                                <x-input-label for="pickup_location" :value="__('Pickup Location')"/>
                                <x-text-input id="pickup_location" name="pickup_location" type="text"
                                              class="mt-1 block w-full"
                                              :value="$order->pickup_location" required autofocus disabled/>
                            </div>

                            <div>
                                <x-input-label for="delivery_at" :value="__('Delivery At')"/>
                                <x-text-input id="delivery_at" name="delivery_at" type="text"
                                              class="mt-1 block w-full"
                                              :value="$order->delivery_at" required autofocus disabled/>
                            </div>

                            <div>
                                <x-input-label for="delivery_at" :value="__('Delivery Location')"/>
                                <x-text-input id="delivery_at" name="delivery_at" type="text"
                                              class="mt-1 block w-full"
                                              :value="$order->delivery_at" required autofocus disabled/>
                            </div>

                            <div>
                                <x-input-label for="current_status" :value="__('Current Status')"/>
                                <x-text-input id="current_status" name="current_status" type="text"
                                              class="mt-1 block w-full"
                                              :value="$order->status" required autofocus disabled/>
                            </div>
                        </div>
                        <div>
                            @if ($nextStatus = \App\Models\Order::$nextStatus[$order->status])
                                <div>
                                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                        {{ __("Change status to ") }}
                                        @if(is_array($nextStatus))
                                            @foreach($nextStatus as $next)
                                                <x-primary-button
                                                    form="update-order-status-{{ $next }}">{{ __($next) }}</x-primary-button>
                                                <x-order-update-status status="{{ $next }}"
                                                                       :order="$order"></x-order-update-status>
                                            @endforeach
                                        @else
                                            <x-primary-button
                                                form="update-order-status-{{ $nextStatus }}">{{ __($nextStatus) }}</x-primary-button>
                                            <x-order-update-status :status="$nextStatus"
                                                                   :order="$order"></x-order-update-status>
                                        @endif
                                    </p>
                                </div>
                            @endif
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
