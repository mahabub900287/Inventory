<script src="{{ asset('assets/admin/vendors/vendor-min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- Main js -->
<script src="{{ asset('assets/admin/js/main.js') }}"></script>
<script src="{{ asset('assets/common/js/sweetalert2@10.js') }}"></script>
<script src="{{ asset('assets/common/js/custom-dev.js') }}"></script>
{{ $topScript ?? '' }}
<!--Custom js use development purpose-->
<script src="{{ asset('assets/admin/js/custom.js') }}"></script>
<script>
    $(document).ready(function() {
        $(".notify-item").on("click", function(event) {
            console.log("clicked");
            event.preventDefault();
            var notificationId = $(this).data("notification-id");
            var url = $(this).data("url");
            console.log(notificationId, url);
            // Make an AJAX call to mark the notification as read
            $.ajax({
                url: '/markasread/' + notificationId,
                type: 'GET',
                success: function(response) {
                    // If the notification is marked as read successfully, navigate to the URL
                    window.location.href = url;
                },
                error: function(xhr) {
                    console.error(xhr);
                }
            });
        });
    });
</script>
{{ $bottomScript ?? '' }}
{{-- @vite('resources/js/app.js') --}}
