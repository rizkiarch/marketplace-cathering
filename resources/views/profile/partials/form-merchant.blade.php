<section>
    <form method="post" action="{{ route('profile.merchant', $merchant->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Merchant Information') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __("Update your account's profile information and merchant details.") }}
            </p>
        </header>

        <div>
            <x-input-label for="merchant_company_name" :value="__('Company Name')" />
            <x-text-input id="merchant_company_name" name="company_name" type="text" class="mt-1 block w-full"
                :value="old('company_name', $merchant->company_name)" required />
            <x-input-error :messages="$errors->updateMerchant->get('company_name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="merchant_address" :value="__('Address')" />
            <x-text-input id="merchant_address" name="address" type="text" class="mt-1 block w-full"
                :value="old('address', $merchant->address)" required />
            <x-input-error :messages="$errors->updateMerchant->get('address')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="merchant_contact" :value="__('Contact')" />
            <x-text-input id="merchant_contact" name="contact" type="text" class="mt-1 block w-full"
                :value="old('contact', $merchant->contact)" required />
            <x-input-error :messages="$errors->updateMerchant->get('contact')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="merchant_description" :value="__('Description')" />
            <textarea name="description" id="description" rows="4"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('description', $merchant->description) }}</textarea>

            {{-- <x-textarea id="merchant_description" name="description" class="mt-1 block w-full"
                rows="4">{{ old('description', $merchant->description) }}</x-textarea> --}}
            <x-input-error :messages="$errors->updateMerchant->get('description')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save Merchant Info') }}</x-primary-button>

            @if (session('status') === 'merchant-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
