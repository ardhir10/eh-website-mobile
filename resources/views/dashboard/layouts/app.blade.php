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
                <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-min-h-screen">
                    <div class="tw-animate-spin tw-rounded-full tw-h-12 tw-w-12 tw-border-t-2 tw-border-b-2 tw-border-red-500"></div>
                    <span class="tw-text-sm tw-mt-2">Please wait<span class="dots"></span></span>
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
                        $('#mainContent').html('<div class="tw-text-center tw-py-8"><p class="tw-text-red-500">Error loading content. Please try again.</p></div>');
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
                        <span class="tw-flex tw-justify-center tw-items-center tw-gap-0">
                            <svg class="tw-animate-spin tw-h-5 tw-w-5 tw-mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="tw-opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="tw-opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
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
                                    input.addClass('tw-border-red-500');
                                    const errorMessage = Array.isArray(errors[field]) ? errors[field][0] : errors[field];
                                    input.after(`<span class="validation-error tw-text-red-500 tw-text-sm">${errorMessage}</span>`);
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
    @stack('scripts')
</body>
</html>