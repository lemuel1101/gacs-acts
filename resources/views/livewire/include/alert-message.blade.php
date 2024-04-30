@if (session()->has('success'))
    <div x-data="{ open: true }" class="fixed top-4 left-0 w-full flex items-center justify-center z-50">
        <div x-show="open" x-transition:enter="transition-opacity ease-out duration-300"
            x-transition:leave="transition-opacity ease-in duration-300" class=" flex items-center justify-center ">
            <div x-data="{ fadeOut: false }" x-init="setTimeout(() => { fadeOut = true;
                setTimeout(() => { open = false; }, 300) }, 3000)" x-show="!fadeOut" class="message-container">
                <div
                    class="bg-green-100 text-green-500 font-semibold px-4 py-3 rounded shadow-md flex items-center mb-8">
                    <svg class="w-6 h-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg> <!-- Tailwind CSS Icon -->
                    <span>{{ session('success') }}</span> <!-- Message -->
                </div>
            </div>
        </div>
    </div>
@endif
@error('error')
    <div x-data="{ open: true }" class="fixed top-4 left-0 w-full flex items-center justify-center z-50">
        <div x-show="open" x-transition:enter="transition-opacity ease-out duration-300"
            x-transition:leave="transition-opacity ease-in duration-300"
            class=" flex items-center justify-center w-full h-full">
            <div x-data="{ fadeOut: false }" x-init="setTimeout(() => { fadeOut = true;
                setTimeout(() => { open = false; }, 300) }, 3000)" x-show="!fadeOut" class="message-container">
                <div class="bg-red-100 text-red-500 font-semibold px-4 py-3 rounded shadow-md flex items-center mb-8">
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
