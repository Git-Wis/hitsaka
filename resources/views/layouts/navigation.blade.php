<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <!-- Primary Navigation Menu -->
    <div class="container">
        <div class="d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center">
                <!-- Logo -->
                <div class="navbar-brand">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="d-block" style="height: 2.25rem; width: auto; color: #343a40;" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="d-none d-lg-flex ml-4">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="d-none d-lg-flex align-items-center ml-3">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="btn btn-light d-flex align-items-center text-secondary">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="bi bi-chevron-down" width="1em" height="1em" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M7.646 10.854a.5.5 0 0 1-.708 0l-4-4a.5.5 0 1 1 .708-.708L8 9.293l3.646-3.647a.5.5 0 0 1 .708.708l-4 4z"/>
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>


                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="d-lg-none">
                <button class="btn btn-light" @click="open = ! open">
                    <svg class="bi bi-list" width="1em" height="1em" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 12.5a.5.5 0 0 1 .5.5h10a.5.5 0 0 1 0-1h-10a.5.5 0 0 1-.5.5zm0-4a.5.5 0 0 1 .5.5h10a.5.5 0 0 1 0-1h-10a.5.5 0 0 1-.5.5zm0-4a.5.5 0 0 1 .5.5h10a.5.5 0 0 1 0-1h-10a.5.5 0 0 1-.5.5z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'d-block': open, 'd-none': ! open}" class="d-lg-none">
        <div class="py-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-3 pb-1 border-top">
            <div class="px-4">
                <div class="font-weight-bold text-dark">{{ Auth::user()->name }}</div>
                <div class="text-muted">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
