<section id="intro" class="bg-linear">
    <div class="container-lg">
      <div class="swiper main-swiper pt-5">
        <div class="swiper-wrapper">

        @for ($i = 1; $i <= 3; $i++)
            <div class="swiper-slide">
            <div class="banner-item d-flex text-center align-items-center">
                <div class="row">

                <div class="col-lg-7">
                    <div class="image-holder mb-lg-0 mb-md-2">
                    <img src="{{asset('assets/banner-image'. $i . '.jpg')}}" alt="product" class="img-fluid rounded-4 banner-image">
                    </div>
                </div>

                <div class="col-lg-5 col-md-11 col-sm-10 mx-auto">
                    <div class="banner-content w-100 h-100 position-relative bg-light border rounded-4 mx-auto d-flex align-items-center">
                    <div class="col-lg-9 col-md-6 col-sm-8 text-center mx-auto py-lg-6">
                        <h1 class="display-2">Discount <span class="display-4 text-secondary d-block">On Soft Toys</span>
                        </h1>
                        <p>Looking for a soft toy that will bring joy and comfort to both kids and adults? Look no further than our collection of toys is great.</p>
                        <div class="btn-center mt-4">
                        <a href="#gallery" class="btn btn-primary btn-md text-uppercase rounded-0">Shop Now</a>
                        </div>
                    </div>
                    <div class="bg-pattern-overlay position-absolute">
                        <img src="{{asset('assets/pattern-overlay1.png')}}" alt="pattern" class="img-fluid pattern-overlay">
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        @endfor
        </div>

        <div class="swiper-arrow-wrap position-absolute d-flex align-items-center">
          <div class="swiper-arrow swiper-arrow-prev position-absolute bg-gray-1 p-3">
            <svg class="chevron-left" width="25" height="25">
              <use xlink:href="#chevron-left" />
            </svg>
          </div>
          <div class="swiper-arrow swiper-arrow-next position-absolute bg-gray-1 p-3">
            <svg class="chevron-right" width="25" height="25">
              <use xlink:href="#chevron-right" />
            </svg>
          </div>
        </div>
      </div>
    </div>
  </section>
