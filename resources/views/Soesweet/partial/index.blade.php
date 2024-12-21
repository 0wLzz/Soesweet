<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{asset('img/logo_color.png')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('css/Productstyle.css')}}">
    <link rel="stylesheet" href="{{asset('css/Home.css')}}">

    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Soesweet Bali</title>
</head>

<body>
    @if (@session('status'))
        <script>
            alert( "{{ session('status') }}" )
        </script>
    @endif

    @yield('navbar')

    {{-- User OffCanvas --}}
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="User" aria-labelledby="My Login">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
        @auth
            <h5 style="color:#ED6665"><strong>{{ Auth::user()->name}}</strong></h5>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Address:</strong> {{ Auth::user()->address }}</p>
            <p><strong>Money:</strong> Rp{{ number_format(Auth::user()->money, 2, ',', '.')}}</p>
            <button type="button" class="btn btn-secondary w-100 mb-2" data-bs-toggle="modal" data-bs-target="#topUpModal">Top Up</button>

            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn w-100 mb-2 text-white" style="background-color:#ED6665">Logout</button>
            </form>
        @else
            <p>Please log in to view your details.</p>
        @endauth
        </div>
    </div>

    <!-- Top Up Modal -->
    <div class="modal fade" id="topUpModal" tabindex="-1" aria-labelledby="topUpModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="topUpModalLabel">Top Up Balance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="topUpForm" method="POST" action="{{ route('top_up') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="amount" class="form-label">Select Amount</label>
                            <select class="form-select" id="amount" name="amount" required>
                                <option value="10000">+Rp10.000</option>
                                <option value="50000">+Rp50.000</option>
                                <option value="100000">+Rp100.000</option>
                                <option value="custom">Custom Amount</option>
                            </select>
                        </div>
                        <div class="mb-3" id="customAmountDiv" style="display: none;">
                            <label for="customAmount" class="form-label">Enter Custom Amount</label>
                            <input type="number" class="form-control" id="customAmount" name="customAmount" min="1" step="1">
                        </div>
                        <button type="submit" class="btn w-100 text-white" style="background-color: #98AF95">Top Up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Login and Register -->
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasLogin" aria-labelledby="My Login">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">

            @if ($errors->login->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->login->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div id="login-status" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                <div id="login-status-message"></div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <div class="login-detail">
                <div class="p-0">
                    <div class="col-lg-12 mx-auto">

                        <form id="login-form" method="POST" action="{{ route('user_login')}}">
                            @csrf
                            <input type="hidden" name="form_type" value="login">

                            <input type="text" id="username" name="username" placeholder="Username or Email Address *" class="mb-3 ps-3 text-input w-100"
                            @if(isset($_COOKIE['username'])) value="{{ $_COOKIE['username'] }}" @endif>

                            <input type="password" id="password" name="password" placeholder="Password" class="ps-3 text-input w-100"
                            @if(isset($_COOKIE['password'])) value="{{ $_COOKIE['password'] }}" @endif>


                            <div class="checkbox d-flex justify-content-between mt-4">
                                <p class="checkbox-form">
                                    <label class="">
                                        <input name="remember" type="checkbox" id="remember-me"> Remember me
                                    </label>
                                </p>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer mt-3 d-flex justify-content-center">
                        <button type="submit" id="login-button" class="btn w-100 mb-2 text-white" style="background-color: #ED6665">Login</button>
                        <button type="button" class="btn w-100 text-white" style="background-color:#98AF95" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRegister" aria-controls="offcanvasRegister">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--Register -->
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasRegister" aria-labelledby="My Register">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            @if ($errors->register->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->register->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form id="register-form" method="POST" action="{{ route('user_register') }}">
                @csrf
                <input type="hidden" name="form_type" value="register">
                <input type="text" name="name" placeholder="Name *" class="mb-3 ps-3 text-input w-100" required>

                <input type="email" name="email" placeholder="Email Address *" class="mb-3 ps-3 text-input w-100" required>

                <input type="text" name="address" placeholder="Address *" class="mb-3 ps-3 text-input w-100" required>

                <input type="password" name="password" placeholder="Password *" class="mb-3 ps-3 text-input w-100" required>

                <input type="password" name="password_confirmation" placeholder="Confirm Password *" class="ps-3 text-input w-100" required>

                <div class="modal-footer mt-3 d-flex justify-content-center">
                    <button type="submit" class="btn w-100 mb-2 text-white" style="background-color: #ED6665">Register</button>
                </div>
            </form>
        </div>
    </div>

    <!-- CART Offcanvas Component -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="Cart" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Cart</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <h4 class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-3">
                <span class="text-secondary">Your Cart</span>
                <span class="badge rounded-pill" style="background-color: #ED6665">{{ count($cart) }}</span>
            </h4>
            @if (count($cart))
                <div class="order-md-last">
                    <ul class="list-group mb-3">
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($cart as $item)
                            @php
                                $subTotal = $item['quantity'] * $item['price'];
                                $total += $subTotal;
                            @endphp
                            <li class="list-group-item border-0 d-flex flex-column lh-sm">
                                <div class="d-flex justify-content-between w-100">
                                    <div>
                                        <h5 class="my-0">{{ $item['name'] }}</h5>
                                        <small class="text-body-secondary">{{ "Quantity: " . $item['quantity'] }}</small>
                                    </div>
                                    <span class="text-body-secondary">Rp{{ number_format( $subTotal, 2) }}</span>
                                </div>
                                <form action="{{route('delete_from_cart', $item["id"])}}" method="POST" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </li>
                        @endforeach
                        <li class="list-group-item border-0 d-flex justify-content-end lh-sm">
                            <span class="text-body-secondary">Rp{{ number_format( $total, 2) }}</span>
                        </li>
                    </ul>
                    <a class="w-100 btn btn-lg text-white" style="background-color:#ED6665" type="submit" href="{{route('checkout_product', $total)}}">Continue to Checkout</a>
                </div>
            @else
                <p>You have no items.</p>
            @endif
        </div>
    </div>

@auth
    <!-- Invoice Offcanvas Component -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="Invoice" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Invoice</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <h5 class="offcanvas-title border-bottom pb-3 mb-3" id="offcanvasInvoiceLabel">My Invoices</h5>
            @if (count($invoices))
                <ul class="list-group">
                    @foreach ($invoices as $invoice)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Invoice ID: {{ $invoice->id }}</h6>
                                <small>Date: {{ $invoice->created_at->format('d-M-Y') }}</small>
                                <br>
                                <small>Satatus: <b>{{ $invoice->status }}</b></small>
                            </div>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#invoiceModal{{ $invoice->id }}">
                                View Details
                            </button>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>You have no invoices.</p>
            @endif
        </div>
    </div>

    <!-- Invoice Details Modals -->
    @foreach ($invoices as $invoice)
        <div class="modal fade" id="invoiceModal{{ $invoice->id }}" tabindex="-1" aria-labelledby="invoiceModalLabel{{ $invoice->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="invoiceModalLabel{{ $invoice->id }}">Invoice Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6>Items:</h6>
                        <ul class="list-group mb-3">
                            @foreach ($invoice->invoiceDetails as $detail)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $detail->product->name }}</h6>
                                    <small>Quantity: {{ $detail->quantity }}</small>
                                </div>
                                <span>Rp{{ number_format($detail->quantity * $detail->product->price, 2) }}</span>
                            </li>
                            @endforeach
                        </ul>
                        <p><strong>Total Price:</strong> Rp{{ number_format($invoice->total_price, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endauth

    @yield('content')

    @include('Soesweet.partial.footer')

    <script>
        document.addEventListener("scroll", function () {
            const navbar = document.querySelector(".navbar");
            const heroHeight = document.querySelector(".hero-section").offsetHeight;
            if (window.scrollY > heroHeight) {
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }
        });
    </script>
</body>
