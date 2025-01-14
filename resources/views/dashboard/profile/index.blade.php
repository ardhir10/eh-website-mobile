@extends('dashboard.layouts.app')

@section('content')
<div class="tw-p-4 md:tw-p-6">
    <!-- Profile Header -->
    <div class="tw-bg-white tw-rounded-2xl tw-p-6 tw-mb-6">
        <div class="tw-flex tw-flex-col md:tw-flex-row tw-items-center tw-gap-6">
            <!-- Profile Image -->
            <div class="tw-relative tw-group">
                <div class="tw-size-32 tw-rounded-full tw-overflow-hidden tw-bg-gray-100">
                    <img 
                        src="{{ asset('/assets/images/avatars/1.gif') }}" 
                        alt="Profile Picture"
                        class="tw-w-full tw-h-full tw-object-cover"
                    >
                </div>
                <button class="tw-absolute tw-inset-0 tw-flex tw-items-center tw-justify-center tw-bg-black/50 tw-opacity-0 group-hover:tw-opacity-100 tw-transition-opacity tw-duration-300 tw-rounded-full">
                    <svg class="tw-w-6 tw-h-6 tw-text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </button>
            </div>

            <!-- Profile Info -->
            <div class="tw-flex-1 tw-text-center md:tw-text-left">
                <h1 class="tw-text-2xl tw-font-semibold tw-text-gray-800">Muhammad Lingga</h1>
                <p class="tw-text-gray-500">Software Engineer</p>
                <div class="tw-mt-4 tw-flex tw-flex-wrap tw-gap-2 tw-justify-center md:tw-justify-start">
                    <span class="tw-px-3 tw-py-1 tw-bg-red-50 tw-text-red-600 tw-rounded-full tw-text-sm">Admin</span>
                    <span class="tw-px-3 tw-py-1 tw-bg-blue-50 tw-text-blue-600 tw-rounded-full tw-text-sm">Developer</span>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="tw-flex tw-gap-4 tw-items-center">
                <div class="tw-text-center">
                    <span class="tw-block tw-text-2xl tw-font-semibold tw-text-gray-800">152</span>
                    <span class="tw-text-sm tw-text-gray-500">Projects</span>
                </div>
                <div class="tw-text-center">
                    <span class="tw-block tw-text-2xl tw-font-semibold tw-text-gray-800">4.8</span>
                    <span class="tw-text-sm tw-text-gray-500">Rating</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Content -->
    <div class="tw-grid tw-grid-cols-1 lg:tw-grid-cols-3 tw-gap-6">
        <!-- Left Column -->
        <div class="tw-space-y-6 lg:tw-col-span-2">
            <!-- About -->
            <div class="tw-bg-white tw-rounded-2xl tw-p-6">
                <h2 class="tw-text-lg tw-font-semibold tw-mb-4">About</h2>
                <p class="tw-text-gray-600">
                    Experienced software engineer with a passion for creating elegant solutions. Specialized in web development and system architecture. Always eager to learn and adapt to new technologies.
                </p>
                
                <!-- Contact Information -->
                <div class="tw-mt-6 tw-space-y-3">
                    <div class="tw-flex tw-items-center tw-gap-3">
                        <svg class="tw-w-5 tw-h-5 tw-text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span class="tw-text-gray-600">lingga@example.com</span>
                    </div>
                    <div class="tw-flex tw-items-center tw-gap-3">
                        <svg class="tw-w-5 tw-h-5 tw-text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="tw-text-gray-600">+1 234 567 890</span>
                    </div>
                    <div class="tw-flex tw-items-center tw-gap-3">
                        <svg class="tw-w-5 tw-h-5 tw-text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="tw-text-gray-600">New York, USA</span>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="tw-bg-white tw-rounded-2xl tw-p-6">
                <h2 class="tw-text-lg tw-font-semibold tw-mb-4">Recent Activity</h2>
                <div class="tw-space-y-4">
                    <!-- Activity Item -->
                    <div class="tw-flex tw-gap-4">
                        <div class="tw-flex-shrink-0">
                            <div class="tw-w-10 tw-h-10 tw-bg-blue-50 tw-rounded-full tw-flex tw-items-center tw-justify-center">
                                <svg class="tw-w-5 tw-h-5 tw-text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="tw-font-medium">Created new project</p>
                            <p class="tw-text-sm tw-text-gray-500">2 hours ago</p>
                        </div>
                    </div>
                    <!-- More activity items... -->
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="tw-space-y-6">
            <!-- Skills -->
            <div class="tw-bg-white tw-rounded-2xl tw-p-6">
                <h2 class="tw-text-lg tw-font-semibold tw-mb-4">Skills</h2>
                <div class="tw-flex tw-flex-wrap tw-gap-2">
                    <span class="tw-px-3 tw-py-1 tw-bg-gray-100 tw-rounded-full tw-text-sm">PHP</span>
                    <span class="tw-px-3 tw-py-1 tw-bg-gray-100 tw-rounded-full tw-text-sm">Laravel</span>
                    <span class="tw-px-3 tw-py-1 tw-bg-gray-100 tw-rounded-full tw-text-sm">JavaScript</span>
                    <span class="tw-px-3 tw-py-1 tw-bg-gray-100 tw-rounded-full tw-text-sm">Vue.js</span>
                    <span class="tw-px-3 tw-py-1 tw-bg-gray-100 tw-rounded-full tw-text-sm">MySQL</span>
                    <!-- Add more skills as needed -->
                </div>
            </div>

            <!-- Current Projects -->
            <div class="tw-bg-white tw-rounded-2xl tw-p-6">
                <h2 class="tw-text-lg tw-font-semibold tw-mb-4">Current Projects</h2>
                <div class="tw-space-y-4">
                    <!-- Project Item -->
                    <div class="tw-p-4 tw-border tw-border-gray-100 tw-rounded-xl">
                        <h3 class="tw-font-medium">Project Alpha</h3>
                        <p class="tw-text-sm tw-text-gray-500 tw-mt-1">In Progress</p>
                        <div class="tw-mt-3">
                            <div class="tw-bg-gray-100 tw-rounded-full tw-h-2">
                                <div class="tw-bg-red-500 tw-rounded-full tw-h-2" style="width: 75%"></div>
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