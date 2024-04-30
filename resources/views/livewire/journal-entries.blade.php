<div class="h-full ml-14 mt-14 mb-10 md:ml-64" wire:key="journal-accounts">
    @include('livewire.include.alert-message')
    <div class="container mx-auto py-6 px-4">
        <h1 class="text-3xl py-4 border-b mb-8">Journal Accounts</h1>

        <div class="mb-4 flex justify-between items-center">
            <div class="flex-1 pr-4">
                <div class="relative md:w-1/3">
                    <input type="search" wire:model.live="search"
                        class="w-full pr-4 py-2 border border-teal-600 rounded-lg focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                        placeholder="Search...">
                </div>
            </div>
            <div class="flex">
                <x-secondary-button class="bg-teal-800 text-white" wire:click.prefetch="addj">ADD</x-secondary-button>
            </div>

        </div>
        <div class="overflow-x-auto bg-white border border-teal-600 rounded-lg shadow overflow-y-auto relative"
            style="height: 650px;">
            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                <thead>
                    <tr class="text-left">
                        <th
                            class="bg-green-800 sticky top-0 border-b border-gray-200 px-6 py-2 text-white font-bold tracking-wider uppercase text-xs">
                            Journal id</th>
                        <th
                            class="bg-green-800 sticky top-0 border-b border-gray-200 px-6 py-2 text-white font-bold tracking-wider uppercase text-xs">
                            date</th>
                        <th
                            class="bg-green-800 sticky top-0 border-b border-gray-200 px-6 py-2 text-white font-bold tracking-wider uppercase text-xs">
                            amount</th>
                        <th
                            class="bg-green-800 sticky top-0 border-b border-gray-200 px-6 py-2 text-white font-bold tracking-wider uppercase text-xs">
                           Note</th>
                        <th
                            class="bg-green-800 sticky top-0 border-b border-gray-200 px-6 py-2 text-white font-bold tracking-wider uppercase text-xs">
                            action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($journals->isNotEmpty())
                        @foreach ($journals as $val)
                            <tr class="uppercase text-sm bg-blue-100 font-semibold">
                                <td class="border-dashed border-t border-gray-200">
                                    <span
                                        class="text-gray-700 px-6 py-3 flex items-center font-bold">{{ $val->journal_code }}</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200">
                                    <span
                                        class="text-gray-700 px-6 py-3 flex items-center">{{ $val->created_at->format('F j, Y') }}</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200">
                                    <span class="text-gray-700 px-6 py-3 flex items-center">{{ $val->amount }}</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200">
                                    <span
                                        class="text-gray-700 px-6 py-3 flex items-center">{{ $val->note }}</span>
                                </td>


                                <td class="border-dashed border-t border-gray-200">
                                    <x-secondary-button wire:click="edist">
                                        <svg class="w-4 h-4 inline-block mr-1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M15 3a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h10zm-1 5a1 1 0 011 1v6a1 1 0 01-1 1H6a1 1 0 01-1-1V9a1 1 0 011-1h8z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Edit
                                    </x-secondary-button>
                                    <x-secondary-button wire:click="preview('{{ $val->journal_code }}')">
                                        <svg class="w-4 h-4 inline-block mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                        </svg>
                                        Prev
                                    </x-secondary-button>                            
                                    <x-button wire:click="delete">
                                        <svg class="w-4 h-4 inline-block mr-1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M3 6a1 1 0 011-1h12a1 1 0 011 1v1H3V6zm2 3v9a2 2 0 002 2h8a2 2 0 002-2V9h2a1 1 0 110 2H3a1 1 0 01-1-1zm10-1H5V5a1 1 0 011-1h8a1 1 0 011 1v2z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Del
                                    </x-button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-gray-700 px-6 py-3 flex items-center text-center">No accounts
                                yet!</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    @include('livewire.include.add-journals')
</div>
