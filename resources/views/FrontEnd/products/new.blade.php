
<section id="new-arrival" class="py-lg-7 bg-light">
    <div class="container-lg">

      <div class="row justify-content-center">
        <div class="display-header text-center position-relative">
          <h2 class="display-2 text-center">Newly Arrived</h2>
          <div class="icon-overlay position-absolute">
            <img src="{{asset('assets/star-icon-overlay.png')}}" alt="icon overlay">
          </div>
        </div>
      </div>

      <div class="swiper product-swiper">
        <div class="swiper-wrapper">

            @foreach ($newestToys as $new)
                <div class="swiper-slide">
                    <div class="product-item">
                        <div class="image-holder text-center p-3 mb-4 border rounded-4">
                            <img src="{{$new->image ? asset('img/' . $new->image) : 'https://placehold.co/400/orange/white?text=Toy'}}" alt="toy" class="img-fluid" style="max-height: 250px; max-width:250px; object-fit:cover;">
                        </div>
                        <div class="product-info ps-2 text-center">
                            <h3 class="m-0">
                                {{$new->name}}
                            </h3>

                            <div class="product-price text-primary">{{"$" . number_format($new->price, 0, ',', '.')}}</div>

                            <div class="btn-group d-flex justify-content-center mt-4">
                                @if ($new->stock)
                                    <button class="btn btn-outline-info text-capitalize rounded-pill btn-sm"
                                        @auth
                                            data-bs-toggle="modal"
                                            data-bs-target="#buyNow{{$new->id}}"
                                        @else
                                            data-bs-toggle="offcanvas"
                                            data-bs-target="#offcanvasLogin"
                                        @endauth >Buy Now!
                                    </button>
                                @else
                                    <div class="d-flex justify-content-center mb-4">
                                        <span class="text-danger">Out of Stock</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
      </div>

    </div>
  </section>
