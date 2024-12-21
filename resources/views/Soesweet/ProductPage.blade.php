@extends('Soesweet.partial.index')

@section('navbar')
<!--PinkStuff :v-->
<div class="p-2 text-white d-none d-lg-block pink">
    <div class="d-flex container-fluid justify-content-between">
        <span><img src="{{asset('Asset/WA.png')}}" style="width: 30px; height: 30px;">+62 819-3214-9300</span>
        <span>Jadikan harimu lebih manis bersama SoeSweet!</span>
        <span>Jln. Tukad Yeh Aya No. 143A, Denpasar</span>
    </div>
</div>
    
<!--Navigation putih-->
<nav id="NAV" class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container-fluid d-flex align-items-center">
        <a href="{{route('login')}}" class="navbar-brand">
            <img src="{{asset('Asset/logo_color.png')}}" style="width: 5rem; height" alt="Logo">
            <span class="ms-2 fw-bold" style="color: #ED6665">SoeSweet</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navcon" aria-controls="navcon" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse justify-content-evenly align-center" id="navcon">
            <ul class="navbar-nav w-100 mx-auto">
                <li class="nav-item">
                    <a href="https://gofood.link/a/Miw8pGm" class="nav-link text-dark">GoFood</a>
                </li>
                <li class="nav-item">
                    <a href="https://r.grab.com/g/6-20241126_133827_E0D143B6CD1E4B4592033D7852257850_MEXMPS-6-C6NKJFCBNNT1WA" class="nav-link text-dark">GrabFood</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link text-dark">WhatsApp</a>
                </li>
                <li class="nav-item">
                    <a href="https://shopee.co.id/universal-link/now-food/shop/21723693?deep_and_deferred=1&shareChannel=copy_link" class="nav-link text-dark">Shopee</a>
                </li>
            </ul>
            <div class="d-flex justify-content-end mx-5">
                {{-- User --}}
                <a data-bs-toggle="offcanvas"
                @auth
                href="#User"
                @else
                href="#offcanvasLogin"
                @endauth
                role="button" class="btn m-2" style="background-color:#ED6665;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                    </svg>
                </a>

                <!-- Cart and Invoice Buttons -->
                <a data-bs-toggle="offcanvas"
                @auth
                href="#Cart"
                @else
                href="#offcanvasLogin"
                @endauth
                role="button" class="btn m-2" style="background-color:#ED6665;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-bag" viewBox="0 0 16 16">
                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                    </svg>
                </a>
                <a data-bs-toggle="offcanvas"
                @auth
                href="#Invoice"
                @else
                href="#offcanvasLogin"
                @endauth
                role="button" class="btn m-2" style="background-color:#ED6665;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-receipt" viewBox="0 0 16 16">
                        <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z"/>
                        <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</nav>

@endsection

@section('content')
<!--Opening Header-->
<section class="d-flex align-items-center" id="opening">
    <div id="banner" class="container-fluid m-3 text-white">
        <div class="row align-items-center">
            <div class="col-6 p-5">
                <h1 class="fw-bold">Berbagi Cerita Manis Di Setiap Gigitan</h1>
                <button class="btn btn-light m-2 fs-3 fw-bold">Order Now</button>
            </div>
            <div class="col-6">
                <img src="{{asset('Asset/Mantapz.png')}}" class="img-fluid" alt="BannerImage">
            </div>
        </div>
    </div>
</section>


<!--Tabs-->
<section id="tabs" class="bg-light">
    <div class="container">
        <ul class="nav nav-underline nav-fill d-flex justify-content-center py-3 fs-4" id="tabsNav" role="tablist">
            @foreach ($categories as  $category)
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                            id="{{ $category->name }}-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#{{ $category->name }}"
                            type="button"
                            role="tab"
                            aria-controls="{{ $category->name }}"
                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                        {{ $category->name . ' Edition'}}
                    </button>
                </li>
            @endforeach
        </ul>

        <!-- TAB CONTENTS -->
        <div class="tab-content" id="ntCon">
            @foreach ($products as $categoryData)
                <div id="{{ $categoryData->category->name }}" class="tab-pane fade {{ $loop->first ? 'show active' : '' }} p-3" role="tabpanel" aria-labelledby="{{ $categoryData->category->name }}-tab" tabindex="0">
                    <div class="container-fluid">
                        <div class="row justify-content-start">
                            @foreach ($categoryData->products as $product)
                                <div class="col-12 col-md-4">
                                    <div id="Swpro1" class="card p-1 mb-3 pink">
                                        <img src="{{ asset('Img/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="object-fit: cover; width: 100%; height: 400px;">
                                        <div class="card-body">
                                            <h5 class="card-title text-white">{{ $product->name }}</h5>
                                            <p class="card-text d-none d-md-block text-white">{{ $product->description }}</p>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button href="#" class="btn greenOld text-white fw-bold"
                                                    @auth
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#buyNow{{$product->id}}"
                                                    @else
                                                        data-bs-toggle="offcanvas"
                                                        data-bs-target="#offcanvasLogin"
                                                    @endauth >Buy Now!
                                                </button>

                                                <button class="btn green text-white fw-bold"
                                                    @auth
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#addToCart{{$product->id}}"
                                                    @else
                                                        data-bs-toggle="offcanvas"
                                                        data-bs-target="#offcanvasLogin"
                                                    @endauth >+ Add To Cart
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Buy Now -->
                                <div class="modal fade" id="buyNow{{$product->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel"> Apakah ingin membeli sebuah {{$product->name}} ?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @csrf
                                                <div class="d-flex justify-content-center">
                                                    <a  href="{{route('buy_product', $product)}}" class="btn text-white" style="background-color: #ED6665">Yes</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Modal Add to Cart -->
                                <div class="modal fade" id="addToCart{{$product->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$product->name}}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <form action="{{route('order_product', $product)}}" method="GET">
                                                    @csrf
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" id="productQuantity" name="quantity" min="1" required>
                                                        <div class="input-group-append">
                                                            <button type="submit" class="btn text-white" style="background-color: #ED6665">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>

@endsection
