@extends('dashboard.layouts.app')

@section('content')
<div class="p-4 md:p-6">
    <!-- Profile Header -->
    <div class="bg-white rounded-2xl p-6 mb-6">
        <div class="flex flex-col md:flex-row items-center gap-6">
            <!-- Profile Image -->
            <div class="relative group">
                <div class="size-32 rounded-full overflow-hidden bg-gray-100">
                    <img 
                        src="{{ asset('/assets/images/avatars/1.gif') }}" 
                        alt="Profile Picture"
                        class="w-full h-full object-cover"
                    >
                </div>
                <button class="absolute inset-0 flex items-center justify-center bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-full">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </button>
            </div>

            <!-- Profile Info -->
            <div class="flex-1 text-center md:text-left">
                <h1 class="text-2xl font-semibold text-gray-800">Muhammad Lingga</h1>
                <p class="text-gray-500">Software Engineer</p>
                <div class="mt-4 flex flex-wrap gap-2 justify-center md:justify-start">
                    <span class="px-3 py-1 bg-red-50 text-red-600 rounded-full text-sm">Admin</span>
                    <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-sm">Developer</span>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="flex gap-4 items-center">
                <div class="text-center">
                    <span class="block text-2xl font-semibold text-gray-800">152</span>
                    <span class="text-sm text-gray-500">Projects</span>
                </div>
                <div class="text-center">
                    <span class="block text-2xl font-semibold text-gray-800">4.8</span>
                    <span class="text-sm text-gray-500">Rating</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column -->
        <div class="space-y-6 lg:col-span-2">
            <!-- About -->
            <div class="bg-white rounded-2xl p-6">
                <h2 class="text-lg font-semibold mb-4">About</h2>
                <p class="text-gray-600">
                    Experienced software engineer with a passion for creating elegant solutions. Specialized in web development and system architecture. Always eager to learn and adapt to new technologies.
                </p>
                
                <!-- Contact Information -->
                <div class="mt-6 space-y-3">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-gray-600">lingga@example.com</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="text-gray-600">+1 234 567 890</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-gray-600">New York, USA</span>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-2xl p-6">
                <h2 class="text-lg font-semibold mb-4">Recent Activity</h2>
                <div class="space-y-4">
                    <!-- Activity Item -->
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="font-medium">Created new project</p>
                            <p class="text-sm text-gray-500">2 hours ago</p>
                        </div>
                    </div>
                    <!-- More activity items... -->
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="space-y-6">
            <!-- Skills -->
            <div class="bg-white rounded-2xl p-6">
                <h2 class="text-lg font-semibold mb-4">Skills</h2>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-gray-100 rounded-full text-sm">PHP</span>
                    <span class="px-3 py-1 bg-gray-100 rounded-full text-sm">Laravel</span>
                    <span class="px-3 py-1 bg-gray-100 rounded-full text-sm">JavaScript</span>
                    <span class="px-3 py-1 bg-gray-100 rounded-full text-sm">Vue.js</span>
                    <span class="px-3 py-1 bg-gray-100 rounded-full text-sm">MySQL</span>
                    <!-- Add more skills as needed -->
                </div>
            </div>

            <!-- Current Projects -->
            <div class="bg-white rounded-2xl p-6">
                <h2 class="text-lg font-semibold mb-4">Current Projects</h2>
                <div class="space-y-4">
                    <!-- Project Item -->
                    <div class="p-4 border border-gray-100 rounded-xl">
                        <h3 class="font-medium">Project Alpha</h3>
                        <p class="text-sm text-gray-500 mt-1">In Progress</p>
                        <div class="mt-3">
                            <div class="bg-gray-100 rounded-full h-2">
                                <div class="bg-red-500 rounded-full h-2" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Add more project items as needed -->
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection