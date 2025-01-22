<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{env('APP_NAME') ? env('APP_NAME') : 'Pandawa Shankara Group'}} </title>

    {{-- favicon --}}
    <link rel="icon" href="{{ asset('assets/logo/general-logo.png') }}">


     
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
    @endif
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    @include('layouts.head')

    @stack('css')
    @stack('style')
    <style>
        [x-cloak] { 
            display: none !important; 
        }
        .swal2-popup {
            font-family: 'eh_sansreg-webfont', sans-serif;
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

    {{-- Setup Font Open Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-[var(--winter-gray-1)]">
    <!-- Loader -->
    <div id="pageLoader" class="fixed inset-0 bg-white z-50 flex items-center justify-center">
        <div class="flex flex-col items-center gap-4">
            {{-- <div class="w-16 h-16 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div> --}}
            <div class="loader">
                <img src="{{ asset('assets/logo/logo-eh.png') }}" alt="Loading...">
            </div>
            <p class="text-xl font-sans loading-text">Please wait<span class="dots"></span></p>
        </div>
    </div>

    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-4 md:p-8" id="mainContent">
            @yield('content')
        </div>
    </div>

    <!-- Import Scripts -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    @stack('js')

    <!-- Add this script section at the bottom of your body tag -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Add loadContent as a global function
        function loadContent(url) {
            // Show loading state
            $('#mainContent').html(`
                <div class="flex flex-col items-center justify-center min-h-screen">
                    <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-red-500"></div>
                    <span class="text-sm mt-2">Please wait<span class="dots"></span></span>
                </div>
            `);

            // Fetch content via AJAX
            setTimeout(() => {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        const content = $(response).find('#mainContent').html();
                        $('#mainContent').html(content);

                        // Close sidebar on mobile after navigation
                        if (window.innerWidth < 768 && typeof sidebarOpen !== 'undefined' && sidebarOpen) {
                            toggleSidebar();
                        }
                    },
                    error: function() {
                        $('#mainContent').html('<div class="text-center py-8"><p class="text-red-500">Error loading content. Please try again.</p></div>');
                    }
                });
            }, 1000);
        }

        function reloadPage() {
            window.location.reload();
        }

        $(document).ready(function() {
            // Fungsi untuk mengumpulkan data form
            // Fungsi ini mengumpulkan data dari elemen form seperti input, select, dan textarea.
            // Data yang dikumpulkan disimpan dalam objek formData.
            // Setiap elemen diperiksa berdasarkan jenisnya:
            // - Untuk checkbox, nilai true/false disimpan berdasarkan status checked.
            // - Untuk radio button, hanya nilai dari yang terpilih yang disimpan.
            // - Untuk file, hanya file pertama yang dipilih yang disimpan.
            // - Untuk elemen lainnya, nilai input disimpan langsung.
            // Setelah semua elemen diproses, objek formData dikembalikan.
            function collectFormData(form) {
                let formData = {};
                
                form.find('input, select, textarea').each(function() {
                    const input = $(this);
                    const name = input.attr('name');
                    
                    if (!name || input.attr('type') === 'submit') return;
                    
                    if (input.attr('type') === 'checkbox') {
                        formData[name] = input.prop('checked');
                    } else if (input.attr('type') === 'radio') {
                        if (input.prop('checked')) {
                            formData[name] = input.val();
                        }
                    } else if (input.attr('type') === 'file') {
                        const files = input[0].files;
                        if (files.length > 0) {
                            formData[name] = files[0];
                        }
                    } else {
                        formData[name] = input.val();
                    }
                });

                return formData;
            }

            // Fungsi untuk menangani loading state
            function toggleLoadingState(form, show) {
                const submitBtn = form.find('[type="submit"][data-ajax="true"]');
                const originalBtnText = submitBtn.data('original-text') || submitBtn.html();

                if (show) {
                    // Simpan text asli button
                    submitBtn.data('original-text', originalBtnText);
                    
                    // Tampilkan loading state
                    form.find('input, select, textarea, button').prop('disabled', true);
                    submitBtn.css('opacity', '0.8').html(`
                        <span class="flex justify-center items-center gap-0">
                            <svg class="animate-spin h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Processing<span class="dots"></span>
                        </span>
                    `);
                } else {
                    // Kembalikan ke state normal
                    form.find('input, select, textarea, button').prop('disabled', false);
                    submitBtn.css('opacity', '1').html(originalBtnText);
                }
            }

            // Handler untuk semua form dengan data-ajax="true"
            $(document).on('submit', 'form[data-ajax="true"]', function(e) {
                e.preventDefault();
                const form = $(this);
                const formId = form.attr('id') || 'unnamed-form';
                
                // Clear previous validation errors
                clearValidationErrors(form);
                
                // Get form configuration
                const url = form.attr('action');
                const method = form.attr('method').toUpperCase();
                const hasFiles = form.find('input[type="file"]').length > 0;
                
                // Collect form data
                const formData = hasFiles ? new FormData(form[0]) : collectFormData(form);
                
                // Show loading state
                toggleLoadingState(form, true);

                // Log untuk debugging
                console.log(`Submitting ${formId}:`, hasFiles ? 'Contains files' : formData);

                // Simulate processing time (bisa dihapus di production)
                setTimeout(() => {
                    $.ajax({
                        url: url,
                        type: method,
                        data: formData,
                        processData: !hasFiles,
                        contentType: hasFiles ? false : 'application/x-www-form-urlencoded',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Accept': 'application/json'
                        },
                        success: function(response) {
                            console.log(`${formId} success:`, response);
                            
                            // Handle success
                            showNotification('Success!', response.message || 'Operation completed successfully.', 'success');
                            
                            // Reset form jika diperlukan
                            if (!form.data('no-reset')) {
                                form[0].reset();
                            }
                            
                            // Custom callback
                            if (typeof form.data('success-callback') === 'function') {
                                form.data('success-callback')(response);
                            }
                            
                            // Handle redirect
                            if (response.redirect) {
                                loadContent(response.redirect);
                                window.history.pushState({}, '', response.redirect);
                            }

                            // Handle callback
                            if (response.callback) {
                                window.dispatchEvent(new CustomEvent('callback-event', { detail: response.callback }));
                            }

                            // Dispatch custom event to close drawer
                            window.dispatchEvent(new CustomEvent('close-drawer'));

                            // Reload page with no-refresh
                            setTimeout(() => {
                                loadContent(window.location.href);
                            }, 1000);
                        },
                        error: function(xhr, status, error) {
                            console.log(`${formId} error:`, {
                                status: xhr.status,
                                response: xhr.responseJSON,
                                error: error
                            });

                            if (xhr.status === 422) {
                                const errors = xhr.responseJSON.errors;
                                Object.keys(errors).forEach(field => {
                                    const input = form.find(`[name="${field}"]`);
                                    input.addClass('border-red-500');
                                    const errorMessage = Array.isArray(errors[field]) ? errors[field][0] : errors[field];
                                    input.after(`<span class="validation-error text-red-500 text-sm">${errorMessage}</span>`);
                                });
                            }
                            
                            showNotification('Error!', 
                                xhr.status === 422 ? 'Please check the form for errors.' : 
                                xhr.responseJSON?.message || 'Something went wrong.', 
                                'danger'
                            );
                        },
                        complete: function() {
                            toggleLoadingState(form, false);
                        }
                    });
                }, 1500);
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
                                    button.closest(response.remove_element).fadeOut(500, function() {
                                        $(this).remove();
                                    });
                                } else if (response.redirect) {
                                    setTimeout(() => {
                                        loadContent(response.redirect);
                                        window.history.pushState({}, '', response.redirect);
                                    }, 1000);
                                } else {
                                    setTimeout(() => {
                                        loadContent(window.location.href);
                                    }, 1000);
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
                <div class="fixed top-4 right-4 z-50 max-w-sm w-full bg-white rounded-lg shadow-lg pointer-events-auto transform transition-all duration-300 ease-in-out translate-x-full" role="alert">
                    <div class="p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                ${type === 'success' 
                                    ? '<svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                                    : type === 'warning'
                                    ? '<svg class="h-6 w-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                                    : type === 'danger'
                                    ? '<svg class="h-6 w-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                                    : '<svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                                }
                            </div>
                            <div class="ml-3 w-0 flex-1">
                                <p class="text-sm font-medium text-gray-900">${title}</p>
                                <p class="mt-1 text-sm text-gray-500">${message}</p>
                            </div>
                            <div class="ml-4 flex-shrink-0 flex">
                                <button class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">Close</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `);

            $('body').append(notification);
            setTimeout(() => notification.removeClass('translate-x-full'), 100);
            
            // Auto close after 5 seconds
            setTimeout(() => {
                notification.addClass('translate-x-full');
                setTimeout(() => notification.remove(), 300);
            }, 5000);

            // Handle manual close
            notification.find('button').on('click', function() {
                notification.addClass('translate-x-full');
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
                    confirmButton: 'bg-red-500 text-white rounded-xl px-4 py-2 transition-all duration-300 ease-in-out',
                    cancelButton: 'bg-gray-500 text-white rounded-xl px-4 py-2 transition-all duration-300 ease-in-out'
                }
            };

            return Swal.fire({ ...defaultOptions, ...options });
        }

        // Add this helper function
        function clearValidationErrors(form) {
            form.find('.validation-error').remove();
            form.find('.border-red-500').removeClass('border-red-500');
        }

        // Add input event listeners to clear errors on type
        $(document).on('input', 'form[data-ajax="true"] input, form[data-ajax="true"] select', function() {
            const input = $(this);
            input.removeClass('border-red-500');
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
    @stack('scripts')
</body>
</html>