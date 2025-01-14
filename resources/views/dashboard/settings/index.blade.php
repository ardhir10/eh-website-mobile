@extends('dashboard.layouts.app')

@section('content')
<div class="tw-p-4 md:tw-p-6">
    <!-- Settings Header -->
    <div class="tw-bg-white tw-rounded-2xl tw-p-6 tw-mb-6">
        <h1 class="tw-text-2xl tw-font-semibold">Settings</h1>
        <p class="tw-text-gray-500">Manage your account settings and preferences</p>
    </div>

    <!-- Settings Content -->
    <div class="tw-grid tw-grid-cols-1 lg:tw-grid-cols-4 tw-gap-6">
        <!-- Settings Navigation -->
        <div class="lg:tw-col-span-1">
            <div class="tw-bg-white tw-rounded-2xl tw-p-4">
                <nav class="tw-space-y-1">
                    <button class="tw-w-full tw-flex tw-items-center tw-gap-3 tw-px-4 tw-py-2 tw-text-sm tw-text-red-500 tw-bg-red-50 tw-rounded-xl">
                        <svg class="tw-w-5 tw-h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Account
                    </button>
                    <button class="tw-w-full tw-flex tw-items-center tw-gap-3 tw-px-4 tw-py-2 tw-text-sm tw-text-gray-600 hover:tw-bg-gray-50 tw-rounded-xl">
                        <svg class="tw-w-5 tw-h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Security
                    </button>
                    <button class="tw-w-full tw-flex tw-items-center tw-gap-3 tw-px-4 tw-py-2 tw-text-sm tw-text-gray-600 hover:tw-bg-gray-50 tw-rounded-xl">
                        <svg class="tw-w-5 tw-h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        Notifications
                    </button>
                    <button class="tw-w-full tw-flex tw-items-center tw-gap-3 tw-px-4 tw-py-2 tw-text-sm tw-text-gray-600 hover:tw-bg-gray-50 tw-rounded-xl">
                        <svg class="tw-w-5 tw-h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Preferences
                    </button>
                </nav>
            </div>
        </div>

        <!-- Settings Forms -->
        <div class="lg:tw-col-span-3">
            <!-- Account Settings -->
            <div class="tw-bg-white tw-rounded-2xl tw-p-6">
                <h2 class="tw-text-lg tw-font-semibold tw-mb-6">Account Settings</h2>
                
                <form action="#" method="POST" data-ajax="true" class="tw-space-y-6">
                    <!-- Profile Picture -->
                    <div>
                        <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-2">Profile Picture</label>
                        <div class="tw-flex tw-items-center tw-gap-4">
                            <img src="{{ asset('/assets/images/avatars/1.gif') }}" alt="Current profile photo" class="tw-size-16 tw-object-cover tw-rounded-full">
                            <div>
                                <button type="button" class="tw-bg-white tw-border tw-border-gray-300 tw-rounded-xl tw-px-4 tw-py-2 tw-text-sm tw-font-medium tw-text-gray-700 hover:tw-bg-gray-50">
                                    Change photo
                                </button>
                                <p class="tw-mt-1 tw-text-xs tw-text-gray-500">PNG, JPG or GIF (MAX. 2MB)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Name -->
                    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-6">
                        <div>
                            <label for="first_name" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-2">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="tw-w-full tw-rounded-xl tw-border-gray-300 focus:tw-border-red-500 focus:tw-ring focus:tw-ring-red-200">
                        </div>
                        <div>
                            <label for="last_name" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-2">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="tw-w-full tw-rounded-xl tw-border-gray-300 focus:tw-border-red-500 focus:tw-ring focus:tw-ring-red-200">
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-2">Email</label>
                        <input type="email" name="email" id="email" class="tw-w-full tw-rounded-xl tw-border-gray-300 focus:tw-border-red-500 focus:tw-ring focus:tw-ring-red-200">
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-2">Phone Number</label>
                        <input type="tel" name="phone" id="phone" class="tw-w-full tw-rounded-xl tw-border-gray-300 focus:tw-border-red-500 focus:tw-ring focus:tw-ring-red-200">
                    </div>

                    <!-- Bio -->
                    <div>
                        <label for="bio" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-2">Bio</label>
                        <textarea name="bio" id="bio" rows="4" class="tw-w-full tw-rounded-xl tw-border-gray-300 focus:tw-border-red-500 focus:tw-ring focus:tw-ring-red-200"></textarea>
                        <p class="tw-mt-1 tw-text-xs tw-text-gray-500">Brief description for your profile.</p>
                    </div>

                    <!-- Save Button -->
                    <div class="tw-flex tw-justify-end">
                        <button type="submit" data-ajax="true" class="tw-bg-red-500 tw-text-white tw-rounded-xl tw-px-6 tw-py-2 tw-text-sm tw-font-medium hover:tw-bg-red-600 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-red-500 focus:tw-ring-offset-2">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 
@endsection