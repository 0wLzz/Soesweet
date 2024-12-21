@extends('Soesweet.partial.index')

@section('navbar')
<nav class="navbar navbar-expand-md navbar-dark bg-transparent fixed-top">
    <div class="container-fluid shadow-md">
        <!-- Brand Logo -->
        <a class="navbar-brand" href="menu.html">
            <img src="{{asset('Asset/logo_color.png')}}" alt="logo" style="height: 3em;">
            <span class="fw-bold text-white">SoeSweet</span>
        </a>

        <!-- Navbar Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links and Buttons -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav mx-auto d-flex justify-content-evenly w-100">
                <li class="nav-item"><a class="nav-link text-center text-white fw-bold" href="#GAM">About Us</a></li>
                <li class="nav-item"><a class="nav-link text-center text-white fw-bold" href="#Products">Menu</a></li>
                <li class="nav-item"><a class="nav-link text-center text-white fw-bold" href="#Review">Testimonial</a></li>
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
    <!--Home (Heroes) Section-->
    <section class="hero-section d-flex align-items-center text-center">
        <div class="container-md mt-5 py-5 text-white">
            <h1 class="fw-bold fs-1">Berbagi Cerita Manis Di Setiap Gigitan</h1>
            <p class="lead">Selamat datang di SoeSweet, tempat di mana cerita manis bertemu dengan kebahagiaan di setiap gigitan soes yang lembut, renyah, dan diisi dengan berbagai rasa yang membuat hari-harimu manis</p>
            <div class="d-flex justify-content-center m-3">
                <div class="d-flex gap-3">
                    <a href="https://wa.me/" class="btn btn-light bg-transparent border-0 d-none d-md-block" target="_blank" aria-label="WhatsApp">
                        <img src="{{asset('Asset/WA.png')}}" alt="WhatsApp" style="width: 30px; height: 30px;">
                    </a>
                    <a href="https://r.grab.com/g/6-20241126_133827_E0D143B6CD1E4B4592033D7852257850_MEXMPS-6-C6NKJFCBNNT1WA" class="btn btn-light bg-transparent border-0 d-none d-md-block" target="_blank" aria-label="Grab">
                        <img src="{{asset('Asset/Grab.png')}}" alt="Grab" style="width: 30px; height: 30px;">
                    </a>
                    <a href="https://gofood.link/a/Miw8pGm" class="btn btn-light bg-transparent border-0 d-none d-md-block" target="_blank" aria-label="Gojek">
                        <img src="{{asset('Asset/Gojek.png')}}" alt="Gojek" style="width: 24px; height: 24px;">
                    </a>
                    <a href="https://shopee.co.id/universal-link/now-food/shop/21723693?deep_and_deferred=1&shareChannel=copy_link" class="btn btn-light bg-transparent border-0 d-none d-md-block" target="_blank" aria-label="Shopee">
                        <img src="{{asset('Asset/Shopee.png')}}" alt="WhatsApp" style="width: 24px; height: 24px;">
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!--Gallery + About Us + gMaps-->
    <section id = "GAM" class="section py-3">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <!--Carousel (Gallery)-->
                <div id="GalC" class="col-md-6 carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="5000">
                            <img src="{{asset('Asset/Carousell1.png')}}"class="d-block w-100 image-cover" alt="G1">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Soesweet Gallery</h5>
                                <p>Scroll ke kanan untuk koleksi foto lainnya</p>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="5000">
                            <img src="{{asset('Asset/Carousell2.jpeg')}}"class="d-block vw-auto ratio ratio" alt="G2">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Soesweet Gallery</h5>
                                <p>Scroll ke kanan untuk koleksi foto lainnya</p>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="5000">
                            <img src="{{asset('Asset/Carousell3.jpeg')}}"class="d-block vw-auto ratio ratio" alt="G3">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Soesweet Gallery</h5>
                                <p>Scroll ke kanan untuk koleksi foto lainnya</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <!--About Us-->
                        <div id="AbU" class="col-12 col-6 text-white p-3 pink">
                            <h3 class="fw-bold m-2" style="font-size: 5em">Tentang Kami</h3>
                            <p class="m-2 fs-3">Soesweet adalah spesialis creampuff di Bali sejak tahun 2016. Kami hadir untuk menghadirkan inovasi dengan diferensiasi unik, menarik dan pastinya memanjakan mulut manis sweeters.</p>
                        </div>
                    </div>
                    <div class="row">
                        <!--Maps-->
                        <div id="maps" class="col-12 my-3">
                            <div class="ratio ratio-1x1">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.150995464235!2d115.23430647459735!3d-8.677187291370766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd2414ed599dc0d%3A0xca2ee90f1de8eb7d!2sSoesweet.bali!5e0!3m2!1sid!2sid!4v1732944834174!5m2!1sid!2sid" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--Our Products-->
    <section id="Products" class="section py-3">
        <div class="container-fluid bg-light">
            <div class="row align-items-center">
                <div class="col-md-10 mb-3">
                    <h1 class="text-start fw-bold text-black" style="font-size:5em">Produk Kami</h1>
                    <h5>Setiap soes kami dibuat secara authenthic, dengan bahan berkualitas, dan penuh cinta.</h5>
                </div>
                <div class="col-md-2">
                    <a href="{{route('product_page')}}" class="btn btn-lg rounded-pill mb-3 text-white fs-2 fw-bold" style="background-color: #ED6665">Selengkapnya</a>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-4">
                        <div id="top1" class="card p-1" style="background-color: #ED6665">
                            <img src="{{asset('Asset/chocollate-whipped.png')}}" class="card-img-top" alt="Chocolate Whipped">
                            <div class="card-body">
                                <h2 class="card-title text-white">Chocolate Whipped</h2>
                                <p class="card-text d-none d-md-block text-white">Soes Regular Size dengan rasa Chocolate Whipped.</p>
                                <div class="d-grid">
                                    <a href="{{route('product_page')}}" class="btn text-white green" style="background-color: #98AF95"><b>Order Now!</b></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div id="top2" class="card p-1" style="background-color: #ED6665">
                            <img src="{{asset('Asset/soes-kering.png')}}" class="card-img-top" alt="Chocolate Whipped">
                            <div class="card-body">
                                <h2 class="card-title text-white">Soes Kering</h2>
                                <p class="card-text d-none d-md-block text-white">Soes kering dengan berbagai varian rasa</p>
                                <div class="d-grid">
                                    <a href="{{route('product_page')}}" class="btn text-white green" style="background-color: #98AF95"><b>Order Now!</b></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div id="top3" class="card p-1" style="background-color:#ED6665">
                            <img src="{{asset('Asset/soes-kotak.png')}}" class="card-img-top" alt="Chocolate Whipped">
                            <div class="card-body">
                                <h2 class="card-title text-white">Box Mix(4)</h2>
                                <p class="card-text d-none d-md-block text-white">Lebih Puas Paket Box isi 4 pcs soes</p>
                                <div class="d-grid">
                                    <a href="{{route('product_page')}}" class="btn text-white green" style="background-color: #98AF95"><b>Order Now!</b></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

    <!--Reviews-->
    <section id="Review" class="my-3 py-3 bg-light">
        <div id= "revHead" class="container-fluid">
            <div class="row text-center pink">
                <h1 class="fw-bold text-white py-3 m-1" style="font-size: 5em">Apa kata mereka tentang SoeSweet?</h1>
            </div>

            <div class="row py-3 m-2 justify-content-center">
                @foreach ($testimonies as $testimony)
                <div class="col-4">
                    <div class="card shadow-lg mb-3">
                        <img src="{{ asset('Img/' . $testimony->image) }}" alt="{{ $testimony->name }}" style="object-fit: cover; width: 100%; height: 400px;">
                        <div class="card-body">
                            <h5 class="card-title">{{$testimony->name}}</h5>
                            <p class="card-text">{{$testimony->description}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
