    <!-- ic_student_menubar start -->
    <div class="ic_student_menubar ">
        <!-- ic_logo_details -->
        <div class="ic_logo_details">

            <div class="ic-logo-wrapper">
                <img class="img-fluid ic_logo" src="{{ asset('assets/admin/images/logo/avocado.png') }}" alt="">
                <a href="{{ route('company.dashboard') }}">
                    <div class="ic-text-logo">
                        <p class="ic-main-txt">AVOCADO</p>
                        <p class="ic-sub-txt">COMMUNICATIONS</p>
                        <p class="ic-slogan">Seeding whats's next.</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="ic-all-nav-list">

            <div class="ic-nav-list-wrapper">
                <h5 class="ic-nav-title">General</h5>
                <ul class="ic-nav-list">
                    <li class="ic-nav-item-wrapper ">
                        <a class="ic_menubar_item  {{ Request::routeIs('company.dashboard') ? 'active' : '' }}"
                            href="{{ route('company.dashboard') }}">
                            <svg class="ic_icon" width="20" height="21" viewBox="0 0 20 21" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M18.3333 11.3325V17.1667C18.3333 17.6269 17.9602 18 17.5 18H10.8333V11.3325H18.3333ZM9.16663 11.3325V18H2.49996C2.03973 18 1.66663 17.6269 1.66663 17.1667V11.3325H9.16663ZM9.16663 3V9.66583H1.66663V3.83333C1.66663 3.3731 2.03973 3 2.49996 3H9.16663ZM17.5 3C17.9602 3 18.3333 3.3731 18.3333 3.83333V9.66583H10.8333V3H17.5Z"
                                    fill="#90ADD9" />
                            </svg>
                            <span class="links_name">Dashboard</span>
                        </a>
                    </li>
                    <li class="ic-nav-item-wrapper ">
                        <a class="ic_menubar_item {{ Request::routeIs('company.product.index') || Request::routeIs('company.product.create') || Request::routeIs('company.product.edit') || Request::routeIs('company.product.show') || Request::routeIs('company.delivery.index') || Request::routeIs('company.delivery.create') || Request::routeIs('company.delivery.edit') || Request::routeIs('company.delivery.show') || Request::routeIs('company.packaging.index') || Request::routeIs('company.packaging.create') || Request::routeIs('company.packaging.edit') || Request::routeIs('company.packaging.show') || Request::routeIs('company.bundle-product.edit') || Request::routeIs('company.product.csv.create') ? 'active' : '' }}"
                            href="{{ route('company.product.index') }}">
                            <svg class="ic_icon" width="20" height="21" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path
                                    d="M7 4V2H17V4H20.0066C20.5552 4 21 4.44495 21 4.9934V21.0066C21 21.5552 20.5551 22 20.0066 22H3.9934C3.44476 22 3 21.5551 3 21.0066V4.9934C3 4.44476 3.44495 4 3.9934 4H7ZM7 6H5V20H19V6H17V8H7V6ZM9 4V6H15V4H9Z"
                                    fill="#90ADD9" />
                            </svg>
                            <span class="links_name">Inventory</span>
                        </a>
                    </li>
                    <li class="ic-nav-item-wrapper ">
                        <a class="ic_menubar_item {{ Request::routeIs('company.shipment.index') || Request::routeIs('company.shipment.create') || Request::routeIs('company.shipment.edit') || Request::routeIs('company.shipment.show') || Request::routeIs('company.shipment.csv.create') ? 'active' : '' }}"
                            href="{{ route('company.shipment.index') }}">
                            <svg class="ic_icon" width="20" height="21" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path
                                    d="M20.0833 15.1998L21.2854 15.9211C21.5221 16.0632 21.5989 16.3703 21.4569 16.6071C21.4146 16.6774 21.3557 16.7363 21.2854 16.7786L12.5144 22.0411C12.1977 22.2311 11.8021 22.2311 11.4854 22.0411L2.71451 16.7786C2.47772 16.6365 2.40093 16.3294 2.54301 16.0926C2.58523 16.0222 2.64413 15.9633 2.71451 15.9211L3.9166 15.1998L11.9999 20.0498L20.0833 15.1998ZM20.0833 10.4998L21.2854 11.2211C21.5221 11.3632 21.5989 11.6703 21.4569 11.9071C21.4146 11.9774 21.3557 12.0363 21.2854 12.0786L11.9999 17.6498L2.71451 12.0786C2.47772 11.9365 2.40093 11.6294 2.54301 11.3926C2.58523 11.3222 2.64413 11.2633 2.71451 11.2211L3.9166 10.4998L11.9999 15.3498L20.0833 10.4998ZM12.5144 1.30852L21.2854 6.57108C21.5221 6.71315 21.5989 7.02028 21.4569 7.25707C21.4146 7.32745 21.3557 7.38635 21.2854 7.42857L11.9999 12.9998L2.71451 7.42857C2.47772 7.2865 2.40093 6.97937 2.54301 6.74258C2.58523 6.6722 2.64413 6.6133 2.71451 6.57108L11.4854 1.30852C11.8021 1.11851 12.1977 1.11851 12.5144 1.30852ZM11.9999 3.33221L5.88723 6.99983L11.9999 10.6674L18.1126 6.99983L11.9999 3.33221Z"
                                    fill="#90ADD9" />
                            </svg>
                            <span class="links_name">Shipment</span>
                        </a>
                    </li>
                    <li class="ic-nav-item-wrapper ">
                        <a class="ic_menubar_item {{ Request::routeIs('company.shipment.return') ? 'active' : '' }}"
                            href="{{ route('company.shipment.return') }}">
                            <svg class="ic_icon" width="20" height="21" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path
                                    d="M15 18H16.5C17.8807 18 19 16.8807 19 15.5C19 14.1193 17.8807 13 16.5 13H3V11H16.5C18.9853 11 21 13.0147 21 15.5C21 17.9853 18.9853 20 16.5 20H15V22L11 19L15 16V18ZM3 4H21V6H3V4ZM9 18V20H3V18H9Z"
                                    fill="#90ADD9" />
                            </svg>
                            <span class="links_name">Return</span>
                        </a>
                    </li>
                    {{-- <li class="ic-nav-item-wrapper has-dropdown dropdown-btn">
                        <a class="ic_menubar_item " href="javascript: void(0);">
                            <svg class="ic_icon" width="20" height="21" viewBox="0 0 20 21" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3.33337 18.8333C3.33337 17.0652 4.03575 15.3695 5.286 14.1193C6.53624 12.869 8.23193 12.1667 10 12.1667C11.7682 12.1667 13.4638 12.869 14.7141 14.1193C15.9643 15.3695 16.6667 17.0652 16.6667 18.8333H15C15 17.5072 14.4733 16.2355 13.5356 15.2978C12.5979 14.3601 11.3261 13.8333 10 13.8333C8.67396 13.8333 7.40219 14.3601 6.46451 15.2978C5.52682 16.2355 5.00004 17.5072 5.00004 18.8333H3.33337ZM10 11.3333C7.23754 11.3333 5.00004 9.09583 5.00004 6.33333C5.00004 3.57083 7.23754 1.33333 10 1.33333C12.7625 1.33333 15 3.57083 15 6.33333C15 9.09583 12.7625 11.3333 10 11.3333ZM10 9.66667C11.8417 9.66667 13.3334 8.175 13.3334 6.33333C13.3334 4.49167 11.8417 3 10 3C8.15837 3 6.66671 4.49167 6.66671 6.33333C6.66671 8.175 8.15837 9.66667 10 9.66667Z"
                                    fill="#91ADD9" />
                            </svg>

                            <span class="links_name">Products</span>
                        </a>

                        <ul class="ic-sub-menu">
                            <li>
                                <a href="{{ route('company.product.index') }}" class="menu-item">Product</a>
                            </li>
                            <li>
                                <a href="role-list.php" class="menu-item">Bundle Product</a>
                            </li>
                        </ul>
                    </li> --}}
                </ul>
            </div>
        </div>

    </div>
    <!-- ic_student_menubar end -->
