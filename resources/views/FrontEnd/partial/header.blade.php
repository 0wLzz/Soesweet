<head>
    <!-- Other head content -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

@if (@session('status'))
    <script>
        alert( "{{ session('status') }}" )
    </script>
@endif

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
            <div class="login-form p-0">
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
                    <button type="submit" id="login-button" class="btn btn-primary w-100 mb-2">Login</button>
                    <button type="button" class="btn btn-outline-gray w-100" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRegister" aria-controls="offcanvasRegister">Register</button>
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
            <input type="text" name="firstName" placeholder="First Name *" class="mb-3 ps-3 text-input w-100" required>

            <input type="text" name="lastName" placeholder="Last Name *" class="mb-3 ps-3 text-input w-100" required>

            <input type="email" name="email" placeholder="Email Address *" class="mb-3 ps-3 text-input w-100" required>

            <input type="password" name="password" placeholder="Password *" class="mb-3 ps-3 text-input w-100" required>

            <input type="password" name="password_confirmation" placeholder="Confirm Password *" class="ps-3 text-input w-100" required>

            <div class="modal-footer mt-3 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary w-100 mb-2">Register</button>
            </div>
        </form>
    </div>
</div>

{{-- User Detail --}}
<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasUser" aria-labelledby="My Login">
    <div class="offcanvas-header">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
    @auth
        <h5 style="color: #aedde3;"><strong>{{ Auth::user()->name}}</strong></h5>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Money:</strong> ${{ Auth::user()->money }}</p>
        <button type="button" class="btn btn-secondary w-100 mb-2" data-bs-toggle="modal" data-bs-target="#topUpModal">Top Up</button>

        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary w-100 mb-2">Logout</button>
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
                            <option value="10">+$10</option>
                            <option value="50">+$50</option>
                            <option value="100">+$100</option>
                            <option value="custom">Custom Amount</option>
                        </select>
                    </div>
                    <div class="mb-3" id="customAmountDiv" style="display: none;">
                        <label for="customAmount" class="form-label">Enter Custom Amount</label>
                        <input type="number" class="form-control" id="customAmount" name="customAmount" min="1" step="1">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Top Up</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- My Cart -->
<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasCart" aria-labelledby="My Cart">
    <div class="offcanvas-header">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <h4 class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-3">
            <span class="text-secondary">Your Cart</span>
            <span class="badge bg-dark rounded-pill">{{ count($cart) }}</span>
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
                                <span class="text-body-secondary">${{ number_format( $subTotal, 2) }}</span>
                            </div>
                            <form action="{{route('delete_from_cart', $item["id"])}}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </li>
                    @endforeach
                    <li class="list-group-item border-0 d-flex justify-content-end lh-sm">
                        <span class="text-body-secondary">${{ number_format( $total, 2) }}</span>
                    </li>
                </ul>
                <a class="w-100 btn btn-primary btn-lg" type="submit" href="{{route('checkout_toy', $total)}}">Continue to Checkout</a>
            </div>
        @else
            <p>You have no items.</p>
        @endif
    </div>
</div>


@auth
    <!-- My Invoice -->
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasInvoice" aria-labelledby="My Cart">
        <div class="offcanvas-header">
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
                        <ul class="list-group">
                            @foreach ($invoice->invoiceDetails as $detail)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $detail->toy->name }}</h6>
                                    <small>Quantity: {{ $detail->quantity }}</small>
                                </div>
                                <span>${{ number_format($detail->subTotal, 2) }}</span>
                            </li>
                            @endforeach
                        </ul>
                        <p><strong>Total Price:</strong> ${{ number_format($invoice->total_price, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endauth

<header id="header" class="site-header bg-light py-3">
<nav class="navbar navbar-expand-lg" aria-label="Offcanvas navbar large">
    <div class="container-lg">
    <a class="navbar-brand me-5" href="/">
        <img src="{{asset('assets/logo.png')}}" alt="brand" style="height: 7vh; width: 14vh; max-height: 100px; max-width: 200px;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
        <svg class="navbar-icon" width="35" height="35">
        <use xlink:href="#navbar-icon"></use>
        </svg>
    </button>

    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
        <div class="offcanvas-header justify-content-center">
        <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body align-items-center">
            <ul class="navbar-nav ms-5 flex-grow-1 pe-3">
                <li class="nav-item ms-3">
                <a class="nav-link text-dark active" aria-current="page" href="#category">Category</a>
                </li>

                <li class="nav-item ms-3 dropdown">
                <a class="nav-link text-dark active" aria-current="page" href="#gallery">Shop</a>
                </li>

            </ul>

            <div class="navbar-users">
                <ul class="user-items list-unstyled d-none d-lg-flex justify-content-end align-items-center order-3 flex-grow-1 gap-4 m-0">
                    <li>
                        <a href="#" data-bs-toggle="offcanvas"
                            @auth data-bs-target="#offcanvasUser"
                            @else data-bs-target="#offcanvasLogin"

                            @endauth aria-controls="offcanvasLogin">
                            <svg class="user" width="18" height="18">
                                <use xlink:href="#user"></use>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-bs-toggle="offcanvas"
                            @auth data-bs-target="#offcanvasInvoice"
                            @else data-bs-target="#offcanvasLogin"
                            @endauth aria-controls="offcanvasInvoice">
                            <svg class="invoice" width="18" height="18">
                                <use xlink:href="#teddybear"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="position-relative">
                        <a href="#" data-bs-toggle="offcanvas"
                            @auth data-bs-target="#offcanvasCart"
                            @else data-bs-target="#offcanvasLogin"

                            @endauth aria-controls="offcanvasLogin">
                            <svg class="cart" width="18" height="18">
                                <use xlink:href="#cart"></use>
                            </svg>

                            @if (count($cart))
                                <span class="bg-primary text-light rounded-pill position-absolute text-center">{{count($cart)}}</span>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    </div>
</nav>

</header>
 {{-- TopUp JavaScript --}}
    <script>
        document.getElementById('amount').addEventListener('change', function() {
            if (this.value === 'custom') {
                document.getElementById('customAmountDiv').style.display = 'block';
            } else {
                document.getElementById('customAmountDiv').style.display = 'none';
            }
        });
    </script>
