<x-app-layout>
    <div class="py-5">
        <div class="flex flex-col mx-auto items-center justify-center bg-purple-100 w-3/5">
            <div class="text-2xl mb-10">
                Update Venue
            </div>
            <form method="POST" action="{{ route('admin.updateVenue', $venue) }}" enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for=" name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$venue->name}}" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Capacity -->
                <div class="mt-4">
                    <x-input-label for="capacity" :value="__('Capcity')" />
                    <x-text-input id="capacity" class="block mt-1 w-full" type="number" name="capacity" min="0" value="{{$venue->capacity}}" required />
                    <x-input-error :messages="$errors->get('capacity')" class="mt-2" />
                </div>

                <!-- Equipment -->
                <div class="mt-4">
                    <x-input-label for="equipment" :value="__('Equipment')" />
                    <x-text-input id="equipment" class="block mt-1 w-full" type="text" name="equipment" value="{{$venue->equipment}}" />
                    <x-input-error :messages="$errors->get('equipment')" class="mt-2" />
                </div>

                <!-- Deposit -->
                <div class="mt-4">
                    <x-input-label for="deposit_price" :value="__('Deposit Price (RM)')" />
                    <x-text-input id="deposit_price" class="block mt-1 w-full" type="number" name="deposit_price" min="0" value="{{$venue->deposit_price}}" />
                    <x-input-error :messages="$errors->get('deposit_price')" class="mt-2" />
                </div>

                <!-- Dailt Rate -->
                <div class="mt-4">
                    <x-input-label for="daily_rate" :value="__('Daily Rate (RM)')" />
                    <x-text-input id="daily_rate" class="block mt-1 w-full" type="number" name="daily_rate" min="0" value="{{$venue->daily_rate}}" required />
                    <x-input-error :messages="$errors->get('daily_rate')" class="mt-2" />
                </div>

                <!-- Images -->
                <div class="flex flex-col w-full mt-5 border border-black rounded-lg p-5">
                    <span class="text-xl text-center mb-5">Images</span>
                    <div class="flex flex-row justify-evenly">
                        @isset($venue->images)                            
                        @foreach ($venue->images as $image )
                        <img src="data:image/jpeg;base64,{{ base64_encode($image) }}" alt="{{ $venue->name }}" class="h-auto w-32 object-contain">
                        @endforeach
                        @endisset
                    </div>
                </div>
                <div class="mt-4">
                    <x-input-label for="images" :value="__('Images')" />
                    <input id="images" class="block mt-1 w-full" type="file" name="images[]" accept="image/jpeg,image/png,image/gif" multiple max="3" />
                    <x-input-error :messages="$errors->get('images')" class="mt-2" />
                </div>

                <div class="flex flex-row mx-5">
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ml-4">
                            {{ __('Update Venue') }}
                        </x-primary-button>
                    </div>
                    
                    <div class="flex items-center justify-end mt-4">
                        <x-danger-button class="ml-4" formaction="{{route('admin.deleteVenue', $venue)}}">
                            {{ __('Delete Venue') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>