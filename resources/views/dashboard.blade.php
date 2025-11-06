<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>

                <div class="p-6">
                    <div class="flex space-x-2">
                        <a href="{{ route('create_companies') }}"
                            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
                            + New Company
                        </a>
                    </div>

                    <div class="mt-3">
                        <div class="overflow-x-auto rounded-lg shadow border border-gray-200 dark:border-gray-700">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-900">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">#</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Company Name</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Email</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Mobile</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Services</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Country</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">State</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">City</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Branch</th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    <!-- Example dynamic row (uncomment and adapt) -->
                                    {{-- @foreach($companies as $i => $company)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-900">
                                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-200">{{ $i + 1 }}</td>
                                        <td class="px-4 py-3 text-sm font-medium text-gray-900 dark:text-white whitespace-nowrap">{{ $company->name }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">{{ $company->email }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">{{ $company->mobile }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">{{ $company->services }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">{{ $company->country }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">{{ $company->state }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">{{ $company->city }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">{{ $company->branch }}</td>
                                    </tr>
                                    @endforeach --}}

                                    <!-- Empty state -->
                                    <tr>
                                        <td class="px-4 py-6 text-sm text-gray-500 dark:text-gray-400 text-center" colspan="9">
                                            No companies yet. Click <span class="font-semibold text-green-600 dark:text-green-400">+ New Company</span> to add one.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
