<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">Company Profile</h2>
                        <a href="{{ route('admin.companies.index') }}" class="text-indigo-600 hover:text-indigo-900">Back to Companies</a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Company Information</h3>
                            
                            <div class="mb-4">
                                <div class="flex items-center mb-2">
                                    <div class="flex-shrink-0 h-16 w-16">
                                        <img class="h-16 w-16 rounded-full" src="{{ $company->logo_url }}" alt="{{ $company->name }}">
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-xl font-medium text-gray-900">{{ $company->name }}</h4>
                                        <p class="text-sm text-gray-500">{{ $company->headquarters }}</p>
                                    </div>
                                </div>
                            </div>

                            <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Industry</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $company->industry }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Company Size</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $company->company_size }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Founded Year</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $company->founded_year }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Website</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <a href="{{ $company->website }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">
                                            {{ $company->website }}
                                        </a>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                                    <dd class="mt-1">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $company->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                               ($company->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ ucfirst($company->status) }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Visibility</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ $company->is_public ? 'Public' : 'Private' }}
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Company Description</h3>
                            <div class="prose max-w-none">
                                {{ $company->description }}
                            </div>

                            <h3 class="text-lg font-medium text-gray-900 mt-6 mb-4">Owner Information</h3>
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Name</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $company->user->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $company->user->email }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    @if($company->status === 'pending')
                        <div class="mt-8 flex justify-end space-x-4">
                            <form action="{{ route('admin.companies.reject', $company) }}" method="POST">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Reject Company
                                </button>
                            </form>
                            
                            <form action="{{ route('admin.companies.approve', $company) }}" method="POST">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    Approve Company
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout> 