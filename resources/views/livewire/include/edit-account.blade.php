<x-dialog-modal wire:model.live="edit" :maxWidth="'xl'">
    <x-slot name="title">
        {{ __('Adding Accounts') }}
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
                        }, 3000)" x-show="!fadeOut" class="message-container">
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
                <div class="w-full px-3 mb-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="code">
                        Code
                    </label>
                    <x-input wire:model="code"
                        class="appearance-none block w-full bg-gray-100 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="code" type="text" placeholder="Enter code..." />
                </div>

                <div class="w-full px-3 mb-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                        Account Name
                    </label>
                    <x-input wire:model="name"
                        class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 "
                        id="name" type="text" placeholder="Enter account name..." />
                </div>
                <div class="w-full px-3 mb-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="amount">
                        Amount
                    </label>
                    <x-input wire:model="amount"
                        class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 "
                        id="amount" type="text" placeholder="Enter amount..." />
                </div>
                <div class="w-full md:w-1/2 px-3 mb-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="state">
                        Normal balance
                    </label>
                    <div class="relative">
                        <select wire:model="nb"
                            class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-500 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-green-500 focus:ring-green-500"
                            id="state">
                            <option selected>Choose one</option>

                            <option class="text-gray-800" value="Debit">
                                {{ 'Debit' }}
                            </option>
                            <option class="text-gray-800" value="Credit">
                                {{ 'Credit' }}
                            </option>

                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 px-3 mb-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid">
                        Account Type
                    </label>
                    <div class="relative">
                        <select wire:model="type"
                            class="block appearance-none w-full bg-gray-100 border  border-gray-200 text-gray-500 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-green-500 focus:ring-green-500"
                            id="grid">
                            <option selected>Select</option>
                            <!-- Use <optgroup> to group options -->
                            <optgroup label="Assets" class="text-gray-800">
                                <option value="current_asset">Current Asset</option>
                                <option value="Inventory_asset">Inventory Asset</option>
                                <option value="Non-current_asset">Non-current Asset</option>
                                <!-- Add more options within this group -->
                            </optgroup>
                            <optgroup label="Liabilities" class="text-gray-800">
                                <option value="Current_liabilities">Current Liabilities</option>
                                <option value="Long-term_liabilities">Long Term Liabilities</option>
                                <option value="Share-capital">Share Capital</option>
                                <option value="Retained_earning">Retained Earning</option>
                            </optgroup>
                            <optgroup label="Equity" class="text-gray-800">
                                <option value="Owners_equity">Owners Equity</option>
                            </optgroup>
                            <optgroup label="Income" class="text-gray-800">
                                <option value="Sales_revenue">Sales Revenue</option>
                                <option value="Others_revenue">Others Revenue</option>
                            </optgroup>
                            <optgroup label="Expenses" class="text-gray-800">
                                <option value="Payroll_expenses">Payroll Expenses</option>
                                <option value="General_and_administrative">General and Administrative</option>
                            </optgroup>
                            <!-- Add more groups and options as needed -->
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <!-- This div can contain a custom dropdown arrow icon -->
                        </div>
                    </div>
                </div>

            </div>

            <div class="w-full mb-6 pt-3 md:mb-0">
                <label for="message"
                    class="block mb-2 text-xs  font-semibold text-gray-900 dark:text-white uppercase">account
                    Description</label>
                <textarea wire:model="description" id="message" rows="4"
                    class="block p-2.5 w-full h-20 text-md text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:border-green-500 focus:ring-green-500"
                    placeholder="Enter description..."></textarea>

            </div>
        </div>
    </x-slot>
    <x-slot name="footer">
        <x-secondary-button class="ml-3" wire:click="save" wire:loading.attr="disabled"
            class="hover:text-white">
            {{ __('Submit') }}
        </x-secondary-button>
        <x-danger-button class="ml-3" wire:click="cancel" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>

