<div class='md:grid md:grid-cols-3 md:gap-6'>
    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit.prevent="addPatientObservation({{ request('patient') }})">
            <div class="px-4 py-5 bg-white shadow sm:p-6 sm:rounded-md">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-4">
                        <div class="flex">
                            <x-label for="bp_observation" value="{{ __('BP Readings') }}" />
                            <span class="text-red-500">*</span>
                        </div>
                        <x-input id="bp_observation" type="text" class="block w-full mt-1" wire:model.defer="bp_observation" required />
                        @error('bp_observation')<div class="text-sm text-red-600">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="comment" value="{{ __('Comments') }}" />
                        <x-input id="comment" type="text" class="block w-full mt-1" wire:model.defer="comment" />
                        @error('comment')<div class="text-sm text-red-600">{{ $message }}</div>@enderror
                    </div>
                </div>

                <x-button class="mt-4" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-button>
            </div>
        </form>
    </div>
</div>
