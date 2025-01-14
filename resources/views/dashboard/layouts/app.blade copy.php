<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pandawa Shankara Group &mdash; Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Iceland&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
    @endif
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    @stack('css')
    @stack('style')
    <style>
        [x-cloak] { 
            display: none !important; 
        }
        .swal2-popup {
            font-family: 'Iceland', sans-serif;
            border-radius: 12px;
        }
        
        /* Tambahkan animasi untuk dots */
        @keyframes loadingDots {
            0% { content: '.'; }
            33% { content: '..'; }
            66% { content: '...'; }
            100% { content: ''; }
        }

        .dots::after {
            content: '';
            animation: loadingDots 2.1s infinite;
        }
    </style>
</head>
<body class="tw-bg-[var(--winter-gray-1)]">
    <!-- Loader -->
    <div id="pageLoader" class="tw-fixed tw-inset-0 tw-bg-white tw-z-50 tw-flex tw-items-center tw-justify-center">
        <div class="tw-flex tw-flex-col tw-items-center tw-gap-4">
            {{-- <div class="tw-w-16 tw-h-16 tw-border-4 tw-border-blue-500 tw-border-t-transparent tw-rounded-full tw-animate-spin"></div> --}}
            <div class="loader"></div>
            <p class="tw-text-xl tw-font-iceland loading-text">Please wait<span class="dots"></span></p>
        </div>
    </div>

    <div class="tw-flex tw-flex-col md:tw-flex-row tw-min-h-screen">
        <!-- Sidebar -->
        @include('dashboard.layouts.sidebar')

        <!-- Main Content -->
        <div class="tw-flex-1 tw-p-4 md:tw-p-8" id="mainContent">
            @yield('content')
        </div>
    </div>

    <!-- Import Scripts -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('js')

    <!-- Add this script section at the bottom of your body tag -->
    @stack('scripts')
    <script>
        // Add this before your other scripts
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            // Handle form submissions
            $(document).on('submit', 'form[data-ajax="true"]', function(e) {
                e.preventDefault();
                const form = $(this);
                
                // Clear previous validation errors
                clearValidationErrors(form);
                
                const url = form.attr('action');
                const method = form.attr('method').toUpperCase();
                const submitBtn = form.find('[type="submit"][data-ajax="true"]');
                const originalBtnText = submitBtn.html();
                
                // Disable form and show loading
                form.find('input, select, textarea, button').prop('disabled', true);
                submitBtn.css('opacity', '0.8').prop('disabled', true)
                    .html(`<span class="tw-flex tw-justify-center tw-items-center tw-gap-0">
                        <svg class="tw-animate-spin tw-h-5 tw-w-5 tw-mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="tw-opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="tw-opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Processing<span class="dots"></span>
                    </span>`);

                // Collect all form data automatically
                let formData = {};
                
                // Get all inputs, selects, and textareas
                form.find('input, select, textarea').each(function() {
                    const input = $(this);
                    const name = input.attr('name');
                    
                    // Skip if no name attribute or if it's a submit button
                    if (!name || input.attr('type') === 'submit') return;
                    
                    // Handle different input types
                    if (input.attr('type') === 'checkbox') {
                        formData[name] = input.prop('checked');
                    } else if (input.attr('type') === 'radio') {
                        if (input.prop('checked')) {
                            formData[name] = input.val();
                        }
                    } else {
                        formData[name] = input.val();
                    }
                });

                // Add CSRF token
                formData._token = $('meta[name="csrf-token"]').attr('content');

                // Log the collected data (remove in production)
                console.log('Form data being submitted:', formData);

                // Simulate processing time
                setTimeout(() => {
                    $.ajax({
                        url: url,
                        type: method,
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Accept': 'application/json'
                        },
                        success: function(response) {
                            // Show success message
                            showNotification('Success!', response.message || 'Operation completed successfully.', 'success');

                            // Reset form
                            form[0].reset();
                            
                            // Close drawer if exists
                            if (typeof drawerOpen !== 'undefined') {
                                drawerOpen = false;
                            }
                            
                            // Handle redirect if specified
                            if (response.redirect) {
                                loadContent(response.redirect);
                                window.history.pushState({}, '', response.redirect);
                            }

                            if (response.remove_element) {
                                $(response.remove_element).remove();
                            }
                            
                            // Handle modal closing if it's a modal form
                            if (form.closest('.modal').length) {
                                closeModal(form.closest('.modal'));
                            }
                            
                            // Trigger optional callback
                            if (typeof response.callback === 'function') {
                                response.callback();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log('Error details:', {
                                status: xhr.status,
                                response: xhr.responseJSON,
                                error: error
                            });

                            if (xhr.status === 422) {
                                const errors = xhr.responseJSON.errors;
                                Object.keys(errors).forEach(field => {
                                    const input = form.find(`[name="${field}"]`);
                                    input.addClass('tw-border-red-500');
                                    // Add error message only if it doesn't exist
                                    // if (!input.next('.validation-error').length) {
                                    //     input.after(`<span class="validation-error tw-text-red-500 tw-text-sm">${errors[field][0]}</span>`);
                                    // }
                                    const errorMessage = Array.isArray(errors[field]) ? errors[field][0] : errors[field];
                                    input.after(`<span class="validation-error tw-text-red-500 tw-text-sm">${errorMessage}</span>`);
                                });
                                
                                // Show error notification
                                showNotification('Error!', 'Please check the form for errors.', 'danger');
                            } else {
                                // Show general error message
                                showNotification('Error!', xhr.responseJSON?.message || 'Something went wrong.', 'danger');
                            }
                        },
                        complete: function() {
                            // Re-enable all inputs and submit button
                            form.find('input, select, textarea, button').prop('disabled', false);
                            submitBtn.prop('disabled', false).html(originalBtnText);
                            submitBtn.css('opacity', '1');
                        }
                    });
                }, 1500); // Simulate a 1.5-second processing time
            });

            // Handle delete confirmations
            $(document).on('click', '[data-delete-url]', function(e) {
                e.preventDefault();
                const button = $(this);
                const url = button.data('delete-url');
                
                sweetAlert({
                    title: 'Are you sure you want to delete this item?',
                    text: 'This action cannot be undone.',
                    icon: 'warning',
                    confirmButtonText: 'Delete',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _method: 'DELETE'
                            },
                            success: function(response) {
                                showNotification('Success!', response.message || 'Item deleted successfully.', 'success');
                                if (response.remove_element) {
                                    button.closest(response.remove_element).remove();
                                } else if (response.redirect) {
                                    loadContent(response.redirect);
                                    window.history.pushState({}, '', response.redirect);
                                }
                            },
                            error: function(xhr) {
                                showNotification('Error!', xhr.responseJSON?.message || 'Could not delete item.', 'error');
                            }
                        });
                    }
                });
            });
        });

        // Notification function
        function showNotification(title, message, type = 'success') {
            const notification = $(`
                <div class="tw-fixed tw-top-4 tw-right-4 tw-z-50 tw-max-w-sm tw-w-full tw-bg-white tw-rounded-lg tw-shadow-lg tw-pointer-events-auto tw-transform tw-transition-all tw-duration-300 tw-ease-in-out tw-translate-x-full" role="alert">
                    <div class="tw-p-4">
                        <div class="tw-flex tw-items-start">
                            <div class="tw-flex-shrink-0">
                                ${type === 'success' 
                                    ? '<svg class="tw-h-6 tw-w-6 tw-text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                                    : type === 'warning'
                                    ? '<svg class="tw-h-6 tw-w-6 tw-text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                                    : type === 'danger'
                                    ? '<svg class="tw-h-6 tw-w-6 tw-text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                                    : '<svg class="tw-h-6 tw-w-6 tw-text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                                }
                            </div>
                            <div class="tw-ml-3 tw-w-0 tw-flex-1">
                                <p class="tw-text-sm tw-font-medium tw-text-gray-900">${title}</p>
                                <p class="tw-mt-1 tw-text-sm tw-text-gray-500">${message}</p>
                            </div>
                            <div class="tw-ml-4 tw-flex-shrink-0 tw-flex">
                                <button class="tw-bg-white tw-rounded-md tw-inline-flex tw-text-gray-400 hover:tw-text-gray-500">
                                    <span class="tw-sr-only">Close</span>
                                    <svg class="tw-h-5 tw-w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `);

            $('body').append(notification);
            setTimeout(() => notification.removeClass('tw-translate-x-full'), 100);
            
            // Auto close after 5 seconds
            setTimeout(() => {
                notification.addClass('tw-translate-x-full');
                setTimeout(() => notification.remove(), 300);
            }, 5000);

            // Handle manual close
            notification.find('button').on('click', function() {
                notification.addClass('tw-translate-x-full');
                setTimeout(() => notification.remove(), 300);
            });
        }

        // Sweet Alert Function
        function sweetAlert(options = {}) {
            const defaultOptions = {
                title: 'Are you sure?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel',
                customClass: {
                    confirmButton: 'tw-bg-red-500 tw-text-white tw-rounded-xl tw-px-4 tw-py-2 tw-transition-all tw-duration-300 tw-ease-in-out',
                    cancelButton: 'tw-bg-gray-500 tw-text-white tw-rounded-xl tw-px-4 tw-py-2 tw-transition-all tw-duration-300 tw-ease-in-out'
                }
            };

            return Swal.fire({ ...defaultOptions, ...options });
        }

        // Add this helper function
        function clearValidationErrors(form) {
            form.find('.validation-error').remove();
            form.find('.tw-border-red-500').removeClass('tw-border-red-500');
        }

        // Add input event listeners to clear errors on type
        $(document).on('input', 'form[data-ajax="true"] input, form[data-ajax="true"] select', function() {
            const input = $(this);
            input.removeClass('tw-border-red-500');
            input.next('.validation-error').remove();
        });

        // Add this to handle page loader
        window.addEventListener('load', function() {
            const loader = document.getElementById('pageLoader');
            setTimeout(() => {
                loader.style.opacity = '0';
                loader.style.transition = 'opacity 0.5s ease-out';
                setTimeout(() => {
                    loader.style.display = 'none';
                }, 1000);
            }, 1000);
        });

        // Contoh penggunaan lainnya
        function confirmAction(options = {}, callback) {
            sweetAlert(options).then((result) => {
                if (result.isConfirmed && typeof callback === 'function') {
                    callback();
                }
            });
        }
    </script>
</body>
</html>