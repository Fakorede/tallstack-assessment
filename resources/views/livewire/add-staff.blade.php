<div class='md:grid md:grid-cols-3 md:gap-6'>
    <div class="mt-5 md:mt-0 md:col-span-2">
        {{-- @if (session()->has("message"))
            <div class="flex items-center text-green-100 bg-green-500 font-bold text-lg px-4 py-3 ">
                {{ session('message') }}
            </div>
        @endif --}}
        <form wire:submit.prevent="addStaff">
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-4">
                        <div class="flex">
                            <x-label for="first_name" value="{{ __('First Name') }}" />
                            <span class="text-red-500">*</span>
                        </div>
                        <x-input id="first_name" type="text" class="mt-1 block w-full" wire:model.defer="first_name" />
                        @error('first_name')<div class="text-sm text-red-600">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <div class="flex">
                            <x-label for="last_name" value="{{ __('Last Name') }}" />
                            <span class="text-red-500">*</span>
                        </div>
                        <x-input id="last_name" type="text" class="mt-1 block w-full" wire:model.defer="last_name" />
                        @error('last_name')<div class="text-sm text-red-600">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <div class="flex">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <span class="text-red-500">*</span>
                        </div>
                        <x-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="email" />
                        @error('email')<div class="text-sm text-red-600">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="address" value="{{ __('Address') }}" />
                        <x-input id="address" type="text" class="mt-1 block w-full" wire:model.defer="address" />
                        @error('address')<div class="text-sm text-red-600">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="mobile_number" value="{{ __('Mobile Number') }}" />
                        <x-input id="mobile_number" type="text" class="mt-1 block w-full" wire:model.defer="mobile_number" />
                        @error('mobile_number')<div class="text-sm text-red-600">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <div class="flex">
                            <x-label for="role" value="{{ __('Role') }}" />
                            <span class="text-red-500">*</span>
                        </div>
                        <select wire:model.defer="role_id" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full" id="role">
                            <option value="">------------------------Select Staff Role------------------------</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role_id')<div class="text-sm text-red-600">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="gender" value="{{ __('Gender') }}" />
                        <input type="radio" name="female" value="Female" id="gender" wire:model.defer="gender"> Female
                        <input type="radio" name="male" value="Male" id="gender" wire:model.defer="gender"> Male
                    </div>
                </div>
            </div>

            <x-button wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </form>
    </div>
</div>
