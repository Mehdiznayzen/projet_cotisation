<x-app-layout>
    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8 animate-fadeInUp">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-700 rounded-full flex items-center justify-center text-white font-bold text-xl">
                        {{ substr(Auth::user()->name, 0, 1) }}{{ substr(explode(' ', Auth::user()->name)[1] ?? '', 0, 1) }}
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">
                            {{ Auth::user()->name }}
                        </h1>
                        <p class="text-gray-600">
                            Gérez vos informations personnelles et préférences de compte
                        </p>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                
                <div class="animate-fadeInUp delay-100">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="animate-fadeInUp delay-200">
                    @include('profile.partials.update-password-form')
                </div>

                <div class="animate-fadeInUp delay-300">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
