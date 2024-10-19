@extends('front.layouts.app')
@section('content')
    <section class="ic-home-banner ic-section-space ">
        <div class="ic-banner-content">
            <div class="container">
                <div class="row   gx-xl-5 gx-lg-4 gx-md-3">
                    <div class="col-md-6 pb-md-0 pb-4">
                        <div class="ic-left-content h-100">
                            <div class="ic-content d-flex flex-column justify-content-center h-100">
                                <h1 class="title mb-2">
                                    Streamline your E-commerce Journey with our dynamic Local experts
                                </h1>
                                <p class="ic-des mb_25">
                                    Reduce the cost and complication of entering the European
                                    market with the help of our localization experts.
                                </p>
                                {{-- <form action="">
                                    <div class="ic_form form-search-wrapper">
                                        <input type="text" class="form-control" placeholder="Enter First Name">
                                        <button class="ic-btn primary px-2 px-sm-3">Start Free Trial</button>
                                    </div>
                                </form> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="ic-right-content">
                            <div class="ic-demo-image">
                                <img class="img-fluid" src="{{ asset('assets/admin') }}/images/frontend/banner-demo.png"
                                    alt="Avocado">

                                <div class="ic-abs-wrapper">
                                    <img class="top-abs" src="{{ asset('assets/admin') }}/images/frontend/abs/polygon.svg"
                                        alt="Avocado">
                                    <img class="bottom-abs" src="{{ asset('assets/admin') }}/images/frontend/abs/shape.svg"
                                        alt="Avocado">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- about part start -->
    <section class="ic__about-part ic-section-top-space ">
        <div class="container">
            <div class="row reverse-column">
                <div class="col-lg-6">
                    <div class="ic__about--img">
                        <img src="{{ asset('assets/admin') }}/images/about-image.png" class="w-100" alt="circle">
                        <div class="shape">
                            <img src="{{ asset('assets/admin') }}/images/back_shape.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <article class="ic__about--content">
                        <p class="cl-orange fw-600 fs_20 ic-des">About</p>
                        <h2 class="black mb_14 ic-title">Avocado Communication</h2>
                        <p class="fs_16 cl-body mb_14">Reduce the cost and complication of entering the European market with
                            the help of our localization experts.</p>
                        <p class="fs_16 cl-body">With over a decade of experience, we know how to create the right
                            localization plan for your product, increase brand awareness, and maximize profit potential.It’s
                            time to fast-track your entry into the European market with Avocado Communication.</p>
                    </article>
                </div>
            </div>
        </div>
    </section>
    <!-- about part end -->

    <!-- video part Start -->
    <section class="ic__video--part ic__bg--gradient ic-section-space ">
        <div class="container">
            <!-- section heading -->
            <div class="ic__section--heading text-center mb_50">
                <p class="mb_10 cl-orange fw-600">Features</p>
                <h2 class="mb_14">Explore Our Features</h2>
                <p class="fs_16">to setup your site and ready to witness your store’s conversion boosted by 120% a day</p>
            </div>
            <!-- section heading -->

            <div class="ic__ourFeature--main">
                <div class="ic__ourFeature--left">
                    <ul class="ic__ourFeature--nav">
                        <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                            <a href="#" class="ic-tab-link active" data-tabs="one">
                                <div class="ic__ourFeature--icons">
                                    <i class="ri-survey-line"></i>
                                </div>
                                <div class="ic__ourFeature--linkRight">
                                    <h5>VAT Registration and Compliance</h5>
                                    <p>Reduce the cost and complication of entering the European market with the help of our
                                        localization experts.</p>
                                </div>
                            </a>
                        </li>
                        <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                            <a href="#" class="ic-tab-link" data-tabs="two">
                                <div class="ic__ourFeature--icons">
                                    <i class="ri-slideshow-line"></i>
                                </div>
                                <div class="ic__ourFeature--linkRight">
                                    <h5>EPR Registration</h5>
                                    <p>Reduce the cost and complication of entering the European market with the help of our
                                        localization experts.</p>
                                </div>
                            </a>
                        </li>
                        <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">
                            <a href="#" class="ic-tab-link" data-tabs="three">
                                <div class="ic__ourFeature--icons">
                                    <i class="ri-wallet-line"></i>
                                </div>
                                <div class="ic__ourFeature--linkRight">
                                    <h5>IOR Customs Clearance</h5>
                                    <p>Reduce the cost and complication of entering the European market with the help of our
                                        localization experts.</p>
                                </div>
                            </a>
                        </li>
                        <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
                            <a href="#" class="ic-tab-link" data-tabs="four">
                                <div class="ic__ourFeature--icons">
                                    <i class="ri-amazon-line"></i>
                                </div>
                                <div class="ic__ourFeature--linkRight">
                                    <h5>Amazon FBA Prep Service</h5>
                                    <p>Reduce the cost and complication of entering the European market with the help of our
                                        localization experts.</p>
                                </div>
                            </a>
                        </li>
                        <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".6s">
                            <a href="#" class="ic-tab-link" data-tabs="five">
                                <div class="ic__ourFeature--icons">
                                    <i class="ri-briefcase-4-line"></i>
                                </div>
                                <div class="ic__ourFeature--linkRight">
                                    <h5>3PL Fulfillment</h5>
                                    <p>Reduce the cost and complication of entering the European market with the help of our
                                        localization experts.</p>
                                </div>
                            </a>
                        </li>
                        <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".6s">
                            <a href="#" class="ic-tab-link" data-tabs="six">
                                <div class="ic__ourFeature--icons">
                                    <i class="ri-wallet-line"></i>
                                </div>
                                <div class="ic__ourFeature--linkRight">
                                    <h5>CE Compliance</h5>
                                    <p>Reduce the cost and complication of entering the European market with the help of our
                                        localization experts.</p>
                                </div>
                            </a>
                        </li>
                        <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".7s">
                            <a href="#" class="ic-tab-link" data-tabs="seven">
                                <div class="ic__ourFeature--icons">
                                    <i class="ri-store-2-line"></i>
                                </div>
                                <div class="ic__ourFeature--linkRight">
                                    <h5>Online Store Development</h5>
                                    <p>Reduce the cost and complication of entering the European market with the help of our
                                        localization experts.</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="ic__ourFeature--right">
                    <div class="ic__ourFeature--tabs active" id="one">
                        <img src="{{ asset('assets/admin') }}/images/dashboard-tabs.png" class="img-fluid"
                            alt="images">
                    </div>
                    <div class="ic__ourFeature--tabs " id="two">
                        <img src="{{ asset('assets/admin') }}/images/dashboard-tabs.png" class="img-fluid"
                            alt="images">
                    </div>
                    <div class="ic__ourFeature--tabs " id="three">
                        <img src="{{ asset('assets/admin') }}/images/dashboard-tabs.png" class="img-fluid"
                            alt="images">
                    </div>
                    <div class="ic__ourFeature--tabs " id="four">
                        <img src="{{ asset('assets/admin') }}/images/dashboard-tabs.png" class="img-fluid"
                            alt="images">
                    </div>
                    <div class="ic__ourFeature--tabs " id="five">
                        <img src="{{ asset('assets/admin') }}/images/dashboard-tabs.png" class="img-fluid"
                            alt="images">
                    </div>
                    <div class="ic__ourFeature--tabs " id="six">
                        <img src="{{ asset('assets/admin') }}/images/dashboard-tabs.png" class="img-fluid"
                            alt="images">
                    </div>
                    <div class="ic__ourFeature--tabs " id="seven">
                        <img src="{{ asset('assets/admin') }}/images/dashboard-tabs.png" class="img-fluid"
                            alt="images">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- video part end -->

    <section class="ic-prising-plan ic-section-space ">
        <div class="container">
            <!-- section heading -->
            <div class="ic__section--heading text-center mb_50">
                <p class="mb_10 cl-orange fw-600">Pricing</p>
                <h2 class="mb_14">Explore Our Pricing Plan</h2>
                <p>to setup your site and ready to witness your store’s conversion boosted by 120% a day</p>
            </div>


            <div class="ic-prising-plan-card-wrapper">
                <div class="ic-card">
                    <div class="top-heading">
                        <div class="ic-badge">
                            Basic
                        </div>
                        <p class="ic-des">Annual contract. Free annually</p>
                        <h2 class="ic-prise">
                            $69 / <span>Yearly</span>
                        </h2>
                    </div>
                    <div class="mid-des mb_50">
                        <ul>
                            <li>
                                <div class="ic-icon correct">
                                    <i class="ri-check-line"></i>
                                </div>
                                Storage Limit 100 GB
                            </li>
                            <li>
                                <div class="ic-icon wrong">
                                    <i class="ri-close-line"></i>
                                </div>
                                User Limit 20
                            </li>
                            <li>
                                <div class="ic-icon correct">
                                    <i class="ri-check-line"></i>
                                </div>
                                3-5 Day Turnaround
                            </li>
                            <li>
                                <div class="ic-icon correct">
                                    <i class="ri-check-line"></i>
                                </div>
                                Task Delivered one-by-one
                            </li>
                            <li>
                                <div class="ic-icon correct">
                                    <i class="ri-check-line"></i>
                                </div>
                                Update Via Dashboard & Slack
                            </li>
                        </ul>
                    </div>
                    <div class="ic-bottom">
                        <button class="ic-btn">Purchase Now</button>
                    </div>
                </div>
                <div class="ic-card">
                    <div class="top-heading">
                        <div class="ic-badge">
                            Professional
                        </div>
                        <p class="ic-des">Annual contract. Free annually</p>
                        <h2 class="ic-prise">
                            $89 / <span>Yearly</span>
                        </h2>
                    </div>
                    <div class="mid-des mb_50">
                        <ul>
                            <li>
                                <div class="ic-icon correct">
                                    <i class="ri-check-line"></i>
                                </div>
                                Storage Limit 100 GB
                            </li>
                            <li>
                                <div class="ic-icon wrong">
                                    <i class="ri-close-line"></i>
                                </div>
                                User Limit 20
                            </li>
                            <li>
                                <div class="ic-icon correct">
                                    <i class="ri-check-line"></i>
                                </div>
                                3-5 Day Turnaround
                            </li>
                            <li>
                                <div class="ic-icon correct">
                                    <i class="ri-check-line"></i>
                                </div>
                                Task Delivered one-by-one
                            </li>
                            <li>
                                <div class="ic-icon correct">
                                    <i class="ri-check-line"></i>
                                </div>
                                Update Via Dashboard & Slack
                            </li>
                        </ul>
                    </div>
                    <div class="ic-bottom">
                        <button class="ic-btn">Purchase Now</button>
                    </div>
                </div>
                <div class="ic-card">
                    <div class="top-heading">
                        <div class="ic-badge">
                            Business
                        </div>
                        <p class="ic-des">Annual contract. Free annually</p>
                        <h2 class="ic-prise">
                            $99 / <span>Yearly</span>
                        </h2>
                    </div>
                    <div class="mid-des mb_50">
                        <ul>
                            <li>
                                <div class="ic-icon correct">
                                    <i class="ri-check-line"></i>
                                </div>
                                Storage Limit 100 GB
                            </li>
                            <li>
                                <div class="ic-icon wrong">
                                    <i class="ri-close-line"></i>
                                </div>
                                User Limit 20
                            </li>
                            <li>
                                <div class="ic-icon correct">
                                    <i class="ri-check-line"></i>
                                </div>
                                3-5 Day Turnaround
                            </li>
                            <li>
                                <div class="ic-icon correct">
                                    <i class="ri-check-line"></i>
                                </div>
                                Task Delivered one-by-one
                            </li>
                            <li>
                                <div class="ic-icon correct">
                                    <i class="ri-check-line"></i>
                                </div>
                                Update Via Dashboard & Slack
                            </li>
                        </ul>
                    </div>
                    <div class="ic-bottom">
                        <button class="ic-btn">Purchase Now</button>
                    </div>
                </div>
                <div class="ic-card">
                    <div class="top-heading">
                        <div class="ic-badge">
                            Premium
                        </div>
                        <p class="ic-des">Annual contract. Free annually</p>
                        <h2 class="ic-prise">
                            $129 / <span>Yearly</span>
                        </h2>
                    </div>
                    <div class="mid-des mb_50">
                        <ul>
                            <li>
                                <div class="ic-icon correct">
                                    <i class="ri-check-line"></i>
                                </div>
                                Storage Limit 100 GB
                            </li>
                            <li>
                                <div class="ic-icon wrong">
                                    <i class="ri-close-line"></i>
                                </div>
                                User Limit 20
                            </li>
                            <li>
                                <div class="ic-icon correct">
                                    <i class="ri-check-line"></i>
                                </div>
                                3-5 Day Turnaround
                            </li>
                            <li>
                                <div class="ic-icon correct">
                                    <i class="ri-check-line"></i>
                                </div>
                                Task Delivered one-by-one
                            </li>
                            <li>
                                <div class="ic-icon correct">
                                    <i class="ri-check-line"></i>
                                </div>
                                Update Via Dashboard & Slack
                            </li>
                        </ul>
                    </div>
                    <div class="ic-bottom">
                        <button class="ic-btn">Purchase Now</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ic home contact start -->
    <section class="ic_home_contact ic-section-space ">
        <div class="container">
            <div class="ic-contact_info">
                <div class="ic-left_content contact-map"
                    style="background-image: url({{ asset('assets/admin') }}/images/contact-map.png);">
                    <h3 class="mb_30 text-white">Contact Us</h3>
                    <ul>
                        <li>
                            <h5 class="fs_20 text-white mb_18">Address</h5>
                            <div class="d-flex gap-2">
                                <span><i class="ri-map-pin-line"></i></span>
                                <span>Lise- Meitner Str 39-41 10589 Berlin</span>
                            </div>
                        </li>
                        <li>
                            <h5 class="fs_20 text-white mb_18">Phone</h5>
                            <div class="d-flex gap-2">
                                <span><i class="ri-phone-line"></i></span>
                                <span><a href="tel:+49 30 27897 272" class="text-white">+49 30 27897 272</a></span>
                            </div>
                        </li>
                        <li>
                            <h5 class="fs_20 text-white mb_18">Email</h5>
                            <div class="d-flex gap-2">
                                <span><i class="ri-mail-open-line"></i></span>
                                <span>
                                    <a href="mailto:info@avocado.com">info@avocado.com</a>
                                    <a href="mailto:support@avocadocom.eu">support@avocadocom.eu</a>
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="ic-right_content">
                    <h3 class="mb_30 black mb_10">Get in Touch</h3>
                    <p class="cl-body">There are many variations of passages of Lorem Ipsum available,but the majority have
                        suffered alteration in some form, by injected humour,</p>
                    <form action="" class="ic_form">
                        <div class="form-group inline-items ">
                            <div class="item">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Enter name">
                            </div>
                            <div class="item">
                                <label class="form-label" for="email">Email</label>
                                <input type="text" id="email" name="email" class="form-control"
                                    placeholder="Enter email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" class="form-control"
                                placeholder="Enter subject">
                        </div>
                        <div class="form-group mb_30">
                            <label class="form-label" for="message">Your Message</label>
                            <textarea name="message" id="message" class="w-100 form-control ic-textarea" placeholder="Type descriptions"></textarea>
                        </div>
                        <button type="submit" class="btn">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ic home contact end -->
@endsection
