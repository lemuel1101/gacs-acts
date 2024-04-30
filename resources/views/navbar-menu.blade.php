<div class="fixed w-full flex items-center justify-between h-14 text-white z-10">
    <div class="flex justify-between items-center h-14 bg-green-800 shadow-slate-200 shadow-md dark:bg-gray-800 w-full">
        <div
            class="flex items-center justify-start md:justify-center shadow-lg pl-3  w-14 md:w-64 h-14 bg-white  dark:bg-gray-800 ">
            <img class="w-7 h-7 md:w-12 md:h-12 mr-2 rounded-full overflow-hidden shadow shadow-white"
                src="{{ URL('images/logo.png') }}" />
            <span class="hidden md:block uppercase text-green-900 font-bold text-xl">Gacs ACTS</span>
        </div>
        <ul class="flex items-center justify-end rounded flex w-full max-w-xl mr-4 p-2 ">
            <li class="mx-5">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="flex items-center ">
                               <span class="mx-2 uppercase text-xs">{{ Auth::user()->name }}</span> 
                                <button
                                    class="max-md:hidden lg:block max-sm:hidden  flex text-sm border-2 border bg-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md max-md:hidden lg:block max-sm:hidden xs:hidden">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-white  text-sm leading-1 font-medium rounded-md text-white hover:text-white focus:outline-none focus:bg-transparent active:bg-transparent transition ease-in-out duration-150 bg-transparent">
                                        {{ Auth::user()->name }}

                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            </div>
                        @endif

                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-dropdown-link>
                        @endif

                        <div class="border-t border-gray-200"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>

                    </x-slot>
                </x-dropdown>

                <div class="-me-2 flex items-center max-sm:block md:hidden lg:hidden">
                    <div x-data="{ open: false }" class="flex">
                        <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            <div x-show="open" class="mt-80 p-t-80 z-50 relative">
                                <div class="pt-2 pb-3 space-y-1">
                                    <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                                        {{ __('Dashboard') }}
                                    </x-responsive-nav-link>
                                </div>

                                <!-- Responsive Settings Options -->
                                <div class="pt-4 pb-1 border-t border-gray-200">
                                    <div class="flex items-center px-4">
                                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                            <div class="shrink-0 me-3">
                                                <img class="h-10 w-10 rounded-full object-cover"
                                                    src="{{ Auth::user()->profile_photo_url }}"
                                                    alt="{{ Auth::user()->name }}" />
                                            </div>
                                        @endif

                                        <div>
                                            <div class="font-medium text-base text-gray-800 text-left uppercase">
                                                {{ Auth::user()->name }}
                                            </div>
                                            <div class="font-medium text-sm text-gray-500 text-left">
                                                {{ Auth::user()->email }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3 space-y-1">
                                        <!-- Account Management -->
                                        <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                                            {{ __('Profile') }}
                                        </x-responsive-nav-link>

                                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                            <x-responsive-nav-link href="{{ route('api-tokens.index') }}"
                                                :active="request()->routeIs('api-tokens.index')">
                                                {{ __('API Tokens') }}
                                            </x-responsive-nav-link>
                                        @endif

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}" x-data>
                                            @csrf

                                            <x-responsive-nav-link href="{{ route('logout') }}"
                                                @click.prevent="$root.submit();">
                                                {{ __('Log Out') }}
                                            </x-responsive-nav-link>
                                        </form>

                                        <!-- Team Management -->

                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </li>
        </ul>

    </div>
</div>
