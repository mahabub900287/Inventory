<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="ic_table w-100 ic_form">
                    {!! $dataTable->table(['class' => 'table-responsive'], false) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<x-slot name="topStyle">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css"> --}}
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/datatables.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .dataTables_length {
            margin-left: 10px;
            padding-top: 0.5em;
        }

        #dataTableBuilder {
            width: 100% !important;
        }

        /* #dataTableBuilder_filter {
            display: none;
        } */

        #dataTableBuilder_length {
            display: none;
        }

        .ic-img-32 {
            border-radius: 50%;
            height: 40px;
            width: 40px;
        }

        .dataTables_wrapper:after {
            height: 30px;
        }
    </style>
</x-slot>

<x-slot name="topScript">
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    {{-- <script src="//cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script> --}}
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.0/js/buttons.print.min.js"></script>
    <script>
        $('.dataTableBuilder').removeClass('table-bordered');
    </script>
    <!-- Add this script in your blade file or in a separate JS file -->
    <script>
        $(document).ready(function() {
            $('#apply-bulk-action').on('click', function(e) {
                e.preventDefault();
                var selectedIds = [];
                // Get all selected checkbox IDs
                $('.bulk-checkbox:checked').each(function() {
                    selectedIds.push($(this).data('id'));
                });

                // Perform the selected bulk action
                if (selectedIds.length > 0) {
                    // Example: Call a function to handle delete
                    var action = $('#apply-bulk-action').attr('href');
                    handleBulkDelete(selectedIds, action);
                } else {
                    alert('Please select at least one item to delete.');
                }
            });
            // Handle "Select All" checkbox
            $('#bulk-checkbox-all').on('change', function() {
                var isChecked = $(this).prop('checked');
                // Set all checkboxes' state to match the "Select All" checkbox
                $('.bulk-checkbox').prop('checked', isChecked);
                // Show/hide the "Delete Selected" button based on the "Select All" checkbox state
                $('#apply-bulk-action').toggle(isChecked);
            });

            // Function to handle bulk delete
            function handleBulkDelete(ids, actions) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#02a499",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Corrected the dot before .ajax()
                        $.ajax({
                            url: actions,
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            data: {
                                ids: ids,
                            },
                            success: function(response) {
                                notify('success', 'Your item delete successfully');
                                setTimeout(() => {
                                    location.reload();
                                }, 2000);

                            },
                            error: function(error) {
                                console.log(error);
                            },
                        });
                    }
                });
            }

        });
    </script>
    {{ $slot }}
    {!! $dataTable->scripts() !!}
</x-slot>
