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

                @if (session('success'))
                    <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <div class="p-6">
                    <div class="flex space-x-2">
                        <a href="{{ route('add_companies') }}"
                            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
                            + New Company
                        </a>
                    </div>

                    <div class="mt-3">
                        <div class="overflow-x-auto rounded-lg shadow border border-gray-200 dark:border-gray-700">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-900">
                                    <tr>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            #</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Company Name</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Email</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Mobile</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Services</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Country</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            State</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            City</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Branch</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Action</th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @if (isset($companies))
                                        @foreach ($companies as $company)
                                            <tr>
                                                <td class="px-4 py-6 text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="px-4 py-6 text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $company->company_name }}</td>
                                                <td class="px-4 py-6 text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $company->email }}</td>
                                                <td class="px-4 py-6 text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $company->mobile }}</td>
                                                <td class="px-4 py-6 text-sm text-gray-500 dark:text-gray-400">
                                                    {{ is_array($company->services) ? implode(', ', $company->services) : '' }}

                                                </td>
                                                <td class="px-4 py-6 text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $company->country }}</td>
                                                <td class="px-4 py-6 text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $company->state }}</td>
                                                <td class="px-4 py-6 text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $company->city }}</td>
                                                <td class="px-4 py-6 text-sm text-gray-500 dark:text-gray-400">
                                                    {{ is_array($company->branch) ? implode(', ', $company->branch) : '' }}
                                                </td>
                                                <td class="px-4 py-6 text-sm text-gray-500 dark:text-gray-400">
                                                    <div class="flex space-x-2">
                                                        <a href="{{ route('edit_companies', $company->id) }}"
                                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                                                            Edit
                                                        </a>
                                                        <form action="{{ route('delete_companies', $company->id) }}"
                                                            method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded"
                                                                onclick="return confirm('Are you sure you want to delete this company?')">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="px-4 py-6 text-sm text-gray-500 dark:text-gray-400 text-center"
                                                colspan="9">
                                                No companies yet. Click <span
                                                    class="font-semibold text-green-600 dark:text-green-400">+ New
                                                    Company</span> to add one.
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
