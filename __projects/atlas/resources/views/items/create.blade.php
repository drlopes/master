<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight text-gray-800 text-l">
            {{ __('Items') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('items.store') }}" method="get">
                        @csrf
                        <div class="flex flex-col space-y-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                {{ __('Name') }}:
                            </label>
                            <input type="text" name="name" id="name">
                        </div>
                        <button type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
