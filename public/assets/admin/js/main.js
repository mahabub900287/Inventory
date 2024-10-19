(function ($) {
    ("use strict");


    $(".dropdown-btn").on("click", function () {
        event.stopPropagation();
        $(this).children('.ic-sub-menu').slideToggle();
        $(this).prevAll(".dropdown-btn").children('.ic-sub-menu').slideUp();
        $(this).nextAll(".dropdown-btn").children('.ic-sub-menu').slideUp();
    });
    $(document).ready(function () {

        $(".ic-dropdown-btn").on("click", function () {
            event.stopPropagation();
            $(this).children('.ic-dropdown-menu').toggleClass("active");
        });

        $(".ic-toggle-btn").on("click", function () {
            $(".ic_student_menubar_wrapper").toggleClass("open");
            $(".ic-toggle-btn-icon").toggleClass("open");
        });
        $(".ic-searchbar").on("click", function () {
            event.stopPropagation()
            $(this).addClass("active");
        });

        // $('.ic-home-content').on("click", function () {
        //     $(".ic-dropdown-menu").removeClass("active");
        //     $(".ic-searchbar").removeClass("active");
        // })

        $('body').on("click", function () {
            $(".ic-dropdown-menu").removeClass("active");
            $(".ic-searchbar").removeClass("active");
            $(".ic-notification-dropdown").removeClass("active");
        })

        $(".e1_element").fontIconPicker();
    });



    // select picker
    $('.ic-select').selectpicker();
    $('.dropdown-toggle').removeAttr('title');

    $(document).ready(function () {
        $('.ic-select2').select2(
            {
                placeholder: 'Select an option',
                allowClear: true,
            }
        );



        // password show hide
        $(".password-toggler").click(function () {
            $(this).children().toggleClass("ri-eye-off-line ri-eye-line");
            // input = $("#pass-toggle");
            input = $(this).parent(".input-icon-wrapper").find(".pass-toggle");
            input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
        });

        // switch pricing
        $('.pricing-switch').on('click', function () {
            if ($(this).is(':checked')) {
                $(this).closest('.switch-buttons').find('.monthly').addClass('active');
                $(this).closest('.switch-buttons').find('.yearly').removeClass('active');

                $(this).parent(".switch-buttons").parent().parent(".ic-plan-content").find(".ic-monthly-plans").slideDown();
                $(this).parent(".switch-buttons").parent().parent(".ic-plan-content").find(".ic-yearly-plans").slideUp();
            } else {
                $(this).closest('.switch-buttons').find('.monthly').removeClass('active');
                $(this).closest('.switch-buttons').find('.yearly').addClass('active');

                $(this).parent(".switch-buttons").parent().parent(".ic-plan-content").find(".ic-monthly-plans").slideUp();
                $(this).parent(".switch-buttons").parent().parent(".ic-plan-content").find(".ic-yearly-plans").slideDown();
            }
        });

        $(".card-expiry").keyup(function () {
            if (this.value.length == this.maxLength) {
                $(this).next('input').focus();
            }
        });

        $(".form-date").flatpickr();
        // var options = {
        //     colors: ['#9E77ED', '#EB5E28'],
        //     series: [{
        //         name: 'Subscription',
        //         data: [13, 20, 16, 12, 7, 6]
        //     }, {
        //         name: 'Revenue',
        //         data: [4, 13, 6, 12, 16, 11]
        //     }],
        //     chart: {
        //         height: 350,
        //         type: 'area'
        //     },
        //     grid: {
        //         show: true
        //     },
        //     dataLabels: {
        //         enabled: false
        //     },
        //     stroke: {
        //         curve: 'smooth'
        //     },
        //     xaxis: {
        //         categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
        //     },
        //     tooltip: {
        //         x: {
        //             format: 'dd/MM/yy HH:mm'
        //         },
        //     },
        // };

        // var chart = new ApexCharts(document.querySelector("#chart"), options);
        // chart.render();






        // Chart js configure
        // var ctx = document.getElementById("expenseDonutchart").getContext('2d');
        // var expenseDonutchart = new Chart(ctx, {
        //     type: 'doughnut',
        //     data: {
        //         labels: ["Plans", "Supplier", "Product"],
        //         datasets: [
        //             {
        //                 // label: 'Dataset 1',
        //                 backgroundColor: [
        //                     '#FF6C40', '#1890FF', '#8B53FC'
        //                 ],
        //                 data: [10, 20, 30],
        //             }
        //         ]
        //     },
        //     options: {
        //         responsive: true,

        //         plugins: {


        //             legend: {
        //                 padding: 50,
        //                 position: 'bottom',
        //                 title: { display: true, padding: 12 },
        //             }
        //         }
        //     }
        // });

    });

    $(document).ready(function () {
        $(".ic-single-accordian-heading").click(function () {

            $(this).parent(".ic-single-accordian").find(".ic-single-accordian-content").slideToggle();
            // $(this).parent(".ic-single-accordian").prevAll(".ic-single-accordian").find(".ic-single-accordian-content").slideUp();
            // $(this).parent(".ic-single-accordian").nextAll(".ic-single-accordian").find(".ic-single-accordian-content").slideUp();


            $(this).find(".ic_arrow").toggleClass("active");
            // $(this).parent(".ic-single-accordian").nextAll(".ic-single-accordian").children().find(".icon").removeClass("active");
            // $(this).parent(".ic-single-accordian").prevAll(".ic-single-accordian").children().find(".icon").removeClass("active");
        });


        $(".ic-modal-trigger-btn").on("click", function () {
            // modal backdrop
            $('#exampleModalToggle').appendTo("body").modal('show');
        });
        $(".ic-modal-trigger-btn").on("click", function () {
            // modal backdrop
            $('#exampleModalToggle').appendTo("body").modal('show');
        });
        $(".ic-modal-trigger-btn2").on("click", function () {
            // modal backdrop
            $('#exampleModalToggle2').appendTo("body").modal('show');
        });
    });

    // switch pricing
    $('.prepacked-switch').on('click', function () {
        $('.prepacked-content').slideToggle();
    });

    /* ==== form edit delete toggle */
    $(".form-edit-btn").click(function () {
        $(".ic-edit-details").toggleClass("active");
    });

    $(".form-delete-btn").click(function () {
        $(".ic-edit-details, .ic-product-details").addClass("ic-active");
    });

    /* ic add and clear */
    $('.add-btn').on('click', function () {
        $(this).hide();
        $('.close-btn, .ic-input-toggle-2').show();
    })
    $('.close-btn').on('click', function () {
        $(this).hide();
        $('.add-btn, .ic-input-toggle-1').show();
    })

    $('.add-btn').on('click', function () {
        $('.ic-input-toggle-1').hide();
        $('.ic-input-toggle-2').show();
    })
    $('.close-btn').on('click', function () {
        $('.ic-input-toggle-2').hide();
        $('.ic-input-toggle-1').show();
    })

    /* notification toggle */
    // $('.ic-dropdown-btn').on('click', function () {
    //     $(this(toggleClass("active")));
    //     $('.close-btn, .ic-input-toggle-2').show();
    // });
    // $(document).ready(function () {
       
    // });
     $(".ic-notification-btn").on("click", function () {
         $(".ic-notification-dropdown").toggleClass("active");
     });

    

})(jQuery);