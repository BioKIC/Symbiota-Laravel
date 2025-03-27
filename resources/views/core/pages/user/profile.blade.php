@props(['user_tokens' => [], 'user' => request()->user()])
@php
use App\Models\UserRole;
use Illuminate\Support\Facades\DB;

$collections = App\Models\Collection::query()
->join('userroles', 'tablePK', 'collid')
->whereIn('role', [UserRole::COLL_ADMIN, UserRole::COLL_EDITOR])
->selectRaw('omcollections.*, GROUP_CONCAT(DISTINCT role) as roles')
->groupBy('collid')
->where('uid', $user->uid)
->get();

$checklists = DB::table('fmchecklists')
->join('userroles as ur', 'tablePK', 'clid')
->whereIn('role', [UserRole::CL_ADMIN])
->where('ur.uid', $user->uid)
->get();

$datasets = DB::table('omoccurdatasets')
    ->where('uid', $user->uid)
    ->get();

@endphp
<x-layout class="sm:w-[95%] lg:w-[75%] m-auto flex flex-col gap-4 p-0">
    {{--<div class="mt-4">
        <x-breadcrumbs :items="[
            ['title' => 'Home', 'href' => url('') ],
            ['title' => 'Previous', 'href' => url('') ],
            'User Settings'
        ]" />
    </div>
    --}}

    <h1 class="text-4xl font-bold sr-only">User Settings</h1>

    <div class="mt-4 flex gap-2 items-center">
        <div
            class="font-bold border border-base-300 rounded-full w-10 h-10 bg-base-300 flex items-center justify-center">
            {{ substr($user->name, 0, 1) }}
        </div>
        <div class="text-2xl font-bold">{{$user->name}}</div>
    </div>

    <div class="flex flex-cols-2 mb-4" x-data="{ active_tab: 'Profile' }">
        {{-- Navigation Menu --}}
        <div class="flex-shrink">
            @foreach ([
                ['label' => 'Profile', 'icon' => 'fa-solid fa-user'],
                ['label' => 'Projects and checklists', 'icon' => 'fa-solid fa-list'],
                ['label' => 'Collections', 'icon' => 'fa-solid fa-jar'],
                ['label' => 'Datasets', 'icon' => 'fa-solid fa-database'],
                ['label' => 'Passwords and authentication', 'icon' => 'fa-solid fa-lock'],
                ['label' => 'Developer', 'icon' => 'fa-solid fa-code'],
            ] as $item)
            <button :class="active_tab === '{{ $item['label'] }}'? 'bg-base-200': 'bg-base-100' "
                @click="active_tab = '{{ $item['label'] }}'"
                class="flex items-center gap-4 hover:bg-base-300 px-3 p-1 rounded-md relative cursor-pointer w-full">
                <div x-show="active_tab === '{{ $item['label'] }}'" x-cloak
                    class="bg-accent w-1 h-5 absolute -left-2 rounded-md"></div>
                <span class="w-3 flex items-center justify-center">
                    <i class="{{ $item['icon'] }}"></i>
                </span>
                {{ $item['label'] }}
            </button>
            @endforeach
        </div>

        {{-- Navigation Content --}}
        <div class="pl-10 flex-grow">
            {{-- User Profile --}}
            <div x-show="active_tab === 'Profile'" x-cloak>
                <div class="text-2xl font-bold">Profile</div>
                <hr class="mb-4" />
                @fragment('profile')
                <form hx-put="{{ url('user/profile/metadata') }}" class="flex flex-col gap-4" hx-swap="outerHTML">
                    @csrf
                    <x-input label="Name" id="name" value="{{ $user->name }}" />
                    <x-input label="Email" id="email" value="{{ $user->email }}" />
                    <x-checkbox label="Accessibility Preference" id="accessibilityPref" :checked="$user->dynamicProperties['accessibilityPref'] ?? false"/>
                    <x-input label="ORCID or other GUID" value="{{ $user->guid }}" />
                    <x-input label="Title" id="title" value="{{ $user->title }}" />
                    <x-input label="Institution" id="institution" value="{{ $user->institution }}" />
                    <x-input label="City" id="city" value="{{ $user->city }}" />
                    <x-input label="State" id="state" value="{{ $user->state }}" />
                    <x-input label="Zip Code" id="zip" value="{{ $user->zip }}" />
                    <x-input label="Country" id="country" value="{{ $user->country}}" />

                    <x-button type="submit">Update Profile</x-button>
                    <x-button hx-delete="{{ url('user/profile') }}" variant="error" hx-confirm="Are you sure you wish to delete your account?">Delete Profile</x-button>
                    {{-- TODO (Logan) taxonomic relationships. Not sure how this is tied to user profiles --}}
                </form>
                @endfragment
            </div>
            {{-- Projects and checklists --}}
            <div x-show="active_tab === 'Projects and checklists'" x-cloak class="flex flex-col gap-4">
                <div class="flex items-center">
                    <div class="text-2xl font-bold">Checklists</div>
                    <div class="flex flex-grow justify-end">
                        @can('CL_CREATE')
                        <x-button href="">
                            Create checklist
                        </x-button>
                        @endcan
                    </div>
                </div>
                <hr class="mb-4" />

                @if(count($checklists) <= 0)
                <div>
                    you have no permissions for any checklists.
                </div>
                @endif

                @foreach ($checklists as $checklist)
                <div class="p-2 border border-base-300 rounded-md">
                    <div class="font-bold text-xl">
                        {{ $checklist->name }}
                        <x-link hx-boost="true" href="{{ url('checklists/' . $checklist->clid)}}">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </x-link>
                    </div>
                    @if(!empty($checklist->locality))
                    <div>
                        {{ $checklist->locality }}
                    </div>
                    @endif

                    @if(!empty($checklist->abstract))
                    <div>
                        {{ $checklist->abstract}}
                    </div>
                    @endif
                </div>
                @endforeach

            </div>

            {{-- Collections --}}
            <div x-show="active_tab === 'Collections'" x-cloak class="flex flex-col gap-4">
                <div class="flex items-center">
                    <div class="text-2xl font-bold">Collections</div>
                    <div class="flex flex-grow justify-end">
                        @can('SUPER_ADMIN')
                        <x-button href="{{ url(config('portal.name') . '/collections/misc/collmetadata.php') }}">
                            Create Collection
                        </x-button>
                        @endcan
                    </div>
                </div>
                <hr class="mb-4" />

                @if(count($collections) <= 0)
                <div>
                    You have no permissions for any collections.
                </div>
                @endif

                @foreach ($collections as $collection)
                <div class="flex items-center gap-4 p-4 rounded-md border border-base-300 relative">
                    <img class="w-16 mx-auto flex-shrink" src="{{ $collection->icon }}">
                    <div class="flex-grow">
                        <div class="text-xl font-bold">
                            {{ $collection->collectionName }}
                            <x-link hx-boost="true" href="{{ url('collections/' . $collection->collID)}}">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            </x-link>
                        </div>
                        @php
                        $roles = explode(',', $collection->roles);
                        @endphp
                        <div class="flex gap-2">
                            @foreach ($roles as $role)
                            <div class="bg-base-300 w-fit px-2 rounded-full">
                                @if($role === UserRole::COLL_ADMIN)
                                Admin
                                @elseif($role === UserRole::COLL_EDITOR)
                                Editor
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Datasets --}}
            <div x-show="active_tab === 'Datasets'" x-cloak class="flex flex-col gap-4">
                <div class="flex items-center">
                    <div class="text-2xl font-bold">Datasets</div>
                    <div class="flex flex-grow justify-end">
                        <x-button href="{{url(config('portal.name'))}}/collections/datasets/index.php">
                            Create dataset
                        </x-button>
                    </div>
                </div>
                <hr class="mb-4" />

                @if(count($datasets) <= 0)
                <div>
                    You have no permissions for any datasets.
                </div>
                @endif

                @foreach ($datasets as $dataset)
                <div>
                    <div class="border border-base-300 rounded-md p-2">
                        <div class="text-xl font-bold">
                            {{ empty($dataset->name) ?'[ Empty Name ]' : $dataset->name}}
                            <x-link href="{{ url(config('portal.name'))}}/datasets/public.php?datasetid={{$dataset->datasetID}}">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            </x-link>
                        </div>
                        @if(!empty($dataset->notes))
                            <div>
                            <span class="font-bold">Notes:</span>
                            {{ $dataset->notes }}
                            </div>
                        @endif
                        <div>
                            <span class="font-bold">Created:</span>
                            {{ $dataset->initialTimestamp }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        {{-- Passwords and authentication --}}
        <div x-show="active_tab === 'Passwords and authentication'" x-cloak>
            <div class="text-2xl font-bold">Password</div>
            <hr class="mb-4" />
            @fragment('password')
            <form hx-post="{{ url('user/profile/password') }}" class="flex flex-col gap-4" hx-swap="outerHTML">
                @csrf
                <input type="hidden" value="{{ $user->email }}" name="email" />
                <x-input type="password" label="Old password" id="old_password" />
                <x-input type="password" label="New password" id="new_password" value="{{ old('new_password') }}" />
                <x-input type="password" label="Confirm password" id="confirm_password" value="{{ old('confirm_password') }}" />
                <x-button type="submit">Update Password</x-button>
                <x-link href="#todo">I forgot my password</x-link>
                <x-errors :errors="$errors" />
            </form>
            @endfragment

            <div class="text-2xl font-bold">Two-factor authentication</div>
            <hr class="mb-4" />
            @if(session('status') == 'two-factor-authentication-confirmed')
            <div class="flex flex-col gap-4">
                <p class="font-medium">
                    Two factor authentication confirmed and enabled successfully.
                </p>
                <p>
                    These are the recovery codes needed to get back into the account. Keep these in a safe place
                    losing them may
                    lead to losing access to your account.
                </p>
                <div>
                    @foreach (request()->user()->recoveryCodes() as $code)
                    <div>
                        {{ $code }}
                    </div>
                    @endforeach
                </div>
            </div>
            @elseif(auth()->user()->two_factor_confirmed_at)
            <form hx-delete="{{ url('/user/two-factor-authentication') }}">
                @csrf
                <x-button type="submit">Disable 2FA</x-button>
            </form>
            @elseif (session('status') == 'two-factor-authentication-enabled')
            <div class="flex flex-col gap-4 justify-center w-80">
                <div class="font-medium">
                    Please finish configuring two factor authentication below.
                </div>

                <div>
                    {!! request()->user()->twoFactorQrCodeSvg(); !!}
                </div>

                <form hx-post="{{url('/user/confirmed-two-factor-authentication')}}" hx-swap="outerHTML"
                    hx-target="body" class="flex flex-col gap-4">
                    @csrf
                    <x-input label="Enter your verification code" id="code" />
                    <x-button class="w-fit" type="submit">Confirm 2FA</x-button>
                </form>
            </div>
            @else
            <form hx-post="{{url('/user/two-factor-authentication')}}" hx-swap="outerHTML" hx-target="body">
                @csrf
                <x-button class="w-fit" type="submit">Enable Two Factor Auth</x-button>
            </form>
            @endif

            <x-errors :errors="$errors" />
        </div>

        {{-- Developer --}}
        <div x-show="active_tab === 'Developer'">
            @fragment('tokens')
            <div id="tokens-container" class="flex flex-col gap-4">
                <div>
                    <div class="p-2 flex items-center gap-2">
                        <div class="text-xl font-bold flex-grow">Personal access tokens </div>
                        <form class="m-0" hx-swap="outerHTML" hx-target="#tokens-container"
                            hx-post="{{ url('token/create') }}">
                            <input type="hidden" name="token_name" value="new_token">
                            @csrf
                            <x-button>Generate new token</x-button>
                        </form>
                    </div>
                    <hr>
                </div>

                <span>
                    Tokens you have generate that can be used to access the <x-link target="_blank"
                        href="{{ url('api/documentation') }}">Symbiota API</x-link>
                </span>

                @isset($created_token)
                <div class="mt-4 p-4 border-t border-base-300">
                    Generated api key:
                    <span class="bg-base-300 py-1 px-2 rounded-md">{{ $created_token }}</span>
                    <div class="mt-1 text-warning font-bold">
                        This key cannot be viewed again make sure to keep it somewhere safe
                    </div>
                </div>
                @endisset
                <div class="border border-base-300">
                    @foreach ($user_tokens as $token)
                    <div class="p-4">
                        <div class="flex items-center gap-4">
                            <div class="font-bold flex-grow">
                                <span>{{ $token->name }}</span>
                                @if($token->abilities)
                                <i class="text-base opacity-50">- {{ implode(',', $token->abilities) }}</i>
                                @endif
                            </div>
                            @if($token->last_used_at)
                            <div>Last used {{ $token->last_used_at }}</div>
                            @endif
                            <x-button variant="error" hx-swap="outerHTML" hx-include="input[name='_token']"
                                hx-target="#tokens-container"
                                hx-delete="{{url('token/delete/' . $token->id)}}">Delete</x-button>
                        </div>
                        @if($token->expires_at)
                        <div>Expires {{ $token->expires_at }}</div>
                        @else
                        <div class="text-warning font-bold underline">This token has no expiration date.</div>
                        @endif
                    </div>
                    @if(!$loop->last && count($user_tokens) > 1)
                    <hr />
                    @endif
                    @endforeach
                </div>
            </div>
            @endfragment
        </div>
        {{-- Navigation Content End --}}
    </div>
    </div>
</x-layout>
