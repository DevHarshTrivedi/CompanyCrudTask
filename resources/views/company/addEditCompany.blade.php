<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $type === 'edit' ? 'Edit Company' : 'Add New Company' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <div class="flex space-x-2">
                        <a href="{{ route('dashboard') }}"
                            class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">
                            Back
                        </a>
                    </div>
                    <form
                        action="{{ $type === 'edit' ? route('update_companies', $company->id) : route('create_companies') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mt-4">
                            <x-input-label for="company_logo" :value="__('Company Logo')" />

                            @if ($type === 'edit' && !empty($company->company_logo))
                                <div class="mb-3">
                                    <img src="{{ asset('storage/company_logos/' . $company->company_logo) }}"
                                        alt="Company Logo"
                                        class="h-20 w-20 object-cover rounded-md border border-gray-300">
                                    <p class="text-sm text-gray-400 mt-1">Current Logo</p>
                                </div>
                            @endif

                            <x-text-input id="company_logo" class="block mt-1 w-full" :value="old('company_logo', $company->company_logo ?? '')" type="file" name="company_logo"
                                accept="image/*" />
                        </div>


                        <div class="mt-4">
                            <x-input-label for="company_name" :value="__('Company Name')" />

                            <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name"
                                :value="old('company_name', $company->company_name ?? '')" required autofocus autocomplete="company_name" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email', $company->email ?? '')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="mobile" :value="__('Mobile')" />
                            <x-text-input id="mobile" class="block mt-1 w-full" type="text" name="mobile"
                                :value="old('mobile', $company->mobile ?? '')" required />
                            <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
                        </div>

                        

                        <div x-data="{
                            open: false,
                            selected: {{ isset($company) ? json_encode(is_array($company->services) ? $company->services : json_decode($company->services ?? '[]', true)) : '[]' }},
                            allServices: ['Service 1', 'Service 2', 'Service 3', 'Service 4', 'Service 5']
                        }" class="mt-4 relative">

                            <x-input-label for="services" :value="__('Services')" />

                            <button type="button" @click="open = !open"
                                class="w-full border border-gray-300 text-gray-900 bg-white rounded-md p-2 text-left">
                                <template x-if="selected.length === 0">
                                    <span>Select Services</span>
                                </template>
                                <template x-for="service in selected" :key="service">
                                    <span
                                        class="inline-block bg-indigo-100 text-indigo-800 text-sm rounded px-2 py-1 mr-1"
                                        x-text="service">
                                    </span>
                                </template>
                            </button>

                            <div x-show="open" @click.away="open = false"
                                class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg p-2">
                                <template x-for="service in allServices" :key="service">
                                    <label class="flex items-center space-x-2 cursor-pointer p-1">
                                        <input type="checkbox" :value="service"
                                            :checked="selected.includes(service)"
                                            @change="selected.includes(service) ? selected = selected.filter(s => s !== service) : selected.push(service)">
                                        <span x-text="service"></span>
                                    </label>
                                </template>
                            </div>

                            <template x-for="service in selected" :key="service">
                                <input type="hidden" name="services[]" :value="service">
                            </template>
                        </div>



                        <div class="mt-4">
                            <x-input-label for="country" :value="__('Country')" />
                            <select id="country" name="country" class="block mt-1 w-full text-gray-900">
                                <option value="">Select a country</option>
                                @foreach ($countries as $country)
                                    {{-- <option value="{{ $country['code'] }}">{{ $country['name'] }}</option> --}}
                                    <option value="{{ $country['code'] }}"
                                        {{ old('country', $company->country ?? '') === $country['code'] ? 'selected' : '' }}>
                                        {{ $country['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('country')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="state" :value="__('State')" />
                            <select id="state" name="state" class="block mt-1 w-full border-gray-300 rounded-md">
                                <option value="">Select State</option>
                                @foreach (array_keys($states) as $state)
                                    {{-- <option value="{{ $state }}">{{ $state }}</option> --}}

                                    <option value="{{ $state }}"
                                        {{ old('state', $company->state ?? '') === $state ? 'selected' : '' }}>
                                        {{ $state }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="city" :value="__('City')" />
                            <select id="city" name="city" class="block mt-1 w-full border-gray-300 rounded-md">
                                <option value="">Select City</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="branch" :value="__('Branch')" />

                            @php
if (isset($company)) {
    $selectedBranches = is_array($company->branch)
        ? $company->branch
        : json_decode($company->branch ?? '[]', true);
                                }
                            @endphp

                            <div class="flex flex-wrap gap-3">
                                @foreach (['Main', 'Sub'] as $branch)
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="branch[]" value="{{ $branch }}"
                                            {{ in_array($branch, $selectedBranches ?? []) ? 'checked' : '' }}>
                                        <span class="text-white">{{ $branch }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-4">
                            <x-primary-button class="text-white font-semibold py-2 px-4 rounded"
                                style="background-color: #26dc44; hover:background-color: #b91c1c;">

                                {{ $type === 'edit' ? 'Update Company' : 'Submit' }}
                            </x-primary-button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statesData = @json($states);
            const stateSelect = document.getElementById('state');
            const citySelect = document.getElementById('city');
            const selectedCity = @json($company->city ?? '');

            function populateCities(state) {
                citySelect.innerHTML = '<option value="">Select City</option>';
                if (statesData[state]) {
                    statesData[state].forEach(city => {
                        const option = document.createElement('option');
                        option.value = city;
                        option.textContent = city;
                        if (city === selectedCity) option.selected = true;
                        citySelect.appendChild(option);
                    });
                }
            }

            if (stateSelect.value) {
                populateCities(stateSelect.value);
            }

            stateSelect.addEventListener('change', function() {
                populateCities(this.value);
            });
        });
    </script>

</x-app-layout>
