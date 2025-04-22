                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('search.index')" :active="request()->routeIs('search.index')">
                        {{ __('Search') }}
                    </x-nav-link>
                    <x-nav-link :href="route('mobile-app')" :active="request()->routeIs('mobile-app')">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 mr-1" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17.523 15.3414c-.5511 0-1.0001.449-1.0001 1s.449 1 1.0001 1c.551 0 1-.449 1-1s-.449-1-1-1zm-11.046 0c-.551 0-1 .449-1 1s.449 1 1 1h1c.551 0 1-.449 1-1v-3.5h-2v2.5zm5.523-8.3414c-3.584 0-6.5 2.916-6.5 6.5 0 3.584 2.916 6.5 6.5 6.5s6.5-2.916 6.5-6.5c0-3.584-2.916-6.5-6.5-6.5zm0 12c-3.032 0-5.5-2.468-5.5-5.5s2.468-5.5 5.5-5.5 5.5 2.468 5.5 5.5-2.468 5.5-5.5 5.5zm0-9.5c-2.206 0-4 1.794-4 4h1c0-1.654 1.346-3 3-3v-1zm0 2c-1.103 0-2 .897-2 2h1c0-.551.449-1 1-1v-1z"/>
                            </svg>
                            {{ __('Mobile App') }}
                        </div>
                    </x-nav-link> 