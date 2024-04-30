<div>
    <x-dialog-modal wire:model.live="addjournal" :maxWidth="'5xl'" wire:key="addjournal-modal">
        <x-slot name="title">
            {{ __('Adding Journal Entries') }}
        </x-slot>
        <x-slot name="content">

            <div class="w-full bg-transparent rounded mx-auto px-5 pt-6 mb-4 flex flex-col my-2">
                @error('error')
                    <div x-data="{ open: true }" class="fixed top-4 left-0 w-full flex items-center justify-center z-50">
                        <div x-show="open" x-transition:enter="transition-opacity ease-out duration-300"
                            x-transition:leave="transition-opacity ease-in duration-300"
                            class=" flex items-center justify-center w-full h-full">
                            <div x-data="{ fadeOut: false }" x-init="setTimeout(() => {
                                fadeOut = true;
                                setTimeout(() => { open = false; }, 300)
                            }, 3000)" x-show="!fadeOut"
                                class="message-container">
                                <div
                                    class="bg-red-100 text-red-500 font-semibold px-4 py-3 rounded shadow-md flex items-center mb-8">
                                    <div
                                        class="mx-auto shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                        </svg>
                                    </div>
                                    <span>{{ $message }}</span> <!-- Message -->
                                </div>
                            </div>
                        </div>
                    </div>
                @enderror
                <div class="flex flex-wrap -mx-3 mb-0">
                    <div class="flex w-full">
                        <div class="w-full px-3 mb-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="code">
                                Journal ID
                            </label>
                            <x-input wire:model="journal_code"
                                class="appearance-none block w-full bg-gray-100 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white "
                                id="code" type="text" placeholder="Enter journal id..." />
                            <x-input-error for="journal_code" class="mb-4" />
                        </div>

                        <div class="w-full px-3 mb-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="name">
                                Date
                            </label>
                            <x-input wire:model="date"
                                class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 "
                                id="name" type="date" placeholder="Enter date..." />
                            <x-input-error for="name" class="mb-4" />
                        </div>
                        <div class="w-full px-3 mb-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="amount">
                                Reference
                            </label>
                            <x-input wire:model="ref"
                                class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 "
                                id="amount" type="text" placeholder="Enter reference..." />

                        </div>
                    </div>
                </div>
                <div class="w-full mb-6 pt-3 md:mb-0">
                    <label for="message"
                        class="block mb-2 text-xs  font-semibold text-gray-900 dark:text-white uppercase">
                        Notes</label>
                    <textarea wire:model="note" id="message" rows="4"
                        class="block p-2.5 w-full h-20 text-md text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:border-green-500 focus:ring-green-500"
                        placeholder="Enter description..."></textarea>

                </div>
                <div
                    class="text-lg font-medium text-gray-800 font-semibold rounded-t-lg p-3 bg-gray-300 w-full uppercase mt-5">
                    creating journal entries
                </div>
                <div class="mt-5 w-full text-center mb-5">
                    <div class="flex justify-end mb-5">
                        <button
                            class="p-2 border-none bg-teal-600 rounded text-white font-bold uppercase text-xs hover:bg-green-800"
                            wire:click="addRow" title="adding new row">Add Row</button>
                    </div>
                    <div class="flex justify-between items-center">
                        <table class="w-full rounded">
                            <thead class="bg-gray-300 rounded-lg">
                                <tr class="rounded-lg">
                                    <th class="px-2 p-2 uppercase">account</th>
                                    <th class="px-2 uppercase">Debit</th>
                                    <th class="px-2 uppercase">Credit</th>
                                    <th class="px-2 uppercase">Description</th>
                                    <th class="px-2 uppercase">Amount</th>
                                    <th class="px-2 uppercase">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-body" class="mt-2 py-4">
                                @foreach ($rows as $index => $row)
                                    <tr wire:key="row-{{ $index }}" class="p-4">
                                        <td>
                                            <select wire:model="rows.{{ $index }}.account"
                                                class="px-2 mt-2 border border-gray-300 rounded appearance-none bg-transparent pr-8">
                                                <option disabled selected value="">Select Account</option>
                                                @foreach ($accounts as $c)
                                                    <option class="text-sm text-black" value="{{ $c->code }}"
                                                        wire:key="ac({{ $c->code }})">{{ $c->code }} - {{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input wire:model.live="rows.{{ $index }}.debit"
                                                wire:change="debits({{ $index }})" id="d" type="text"
                                                class="px-2 border mt-2 border-gray-300 rounded text-center"></td>
                                        <td><input wire:model.live="rows.{{ $index }}.credit"
                                                wire:change="credits({{ $index }})" id="c"
                                                type="text"
                                                class="px-2 border mt-2 border-gray-300 rounded text-center"></td>
                                        <td><input wire:model="rows.{{ $index }}.description" type="text"
                                                class="px-2 mt-2 border border-gray-300 rounded"></td>
                                       <td>
                                        <span class="font-bold">{{ $row['amount'] }}</span>
                                       </td>

                                        <td>
                                            <button wire:click="removeRow({{ $index }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                           
                        </table>
                       
                    </div>
                </div>
                <div class="border-b-green-600 justify-end flex text-md font-semibold mt-2 border-b-2 border-opacity-50 mx-2">Debit total: {{ number_format($debitTotal, 2) }}</div>
                <div class="border-b-green-600 justify-end flex text-md font-semibold mt-2  border-b-2 mx-2 border-opacity-50">Credit total: {{ number_format($creditTotal, 2) }}</div>                
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-secondary-button class="ml-3 text-white" wire:click.prefetch="saving" wire:loading.attr="disabled"
                class="hover:text-white">
                {{ __('Submit') }}
            </x-secondary-button>
            <x-danger-button class="ml-3" wire:click="cancel" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Livewire.on('credits', function() {
                var element = document.getElementById('d');
                if (element) {
                    element.disabled = true;
                }
            });
            Livewire.on('debits', function() {
                var element = document.getElementById('c');
                if (element) {
                    element.disabled = true;
                }
            });
        });
    </script>
</div>
