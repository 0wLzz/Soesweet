<section id="gallery" class="py-lg-7 bg-linear">
    <div class="container-lg">

      <div class="row justify-content-center">
        <div class="display-header text-center position-relative">
          <h2 class="display-2 text-center">Our Gallery</h2>
          <div class="icon-overlay position-absolute">
            <img src="{{asset('assets/star-icon-overlay.png')}}" alt="icon overlay">
          </div>
        </div>
      </div>

      <div class="row">

        @foreach ($toys as $toy)
        <div class="col-lg-3 col-md-6">
            <div class="product-item">
                <div class="image-holder text-center p-3 mb-4 border rounded-4">
                    <button class="text-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$toy->id}}" style="background: none; border: none; padding: 0; color: inherit; font: inherit; cursor: pointer;">
                        <img src="{{ $toy->image ? asset('img/' . $toy->image) : 'https://placehold.co/400/orange/white?text=Toy' }}" alt="toy" class="img-fluid" style="max-height: 250px; max-width:250px; object-fit:cover;">
                    </button>
                </div>
                <div class="product-info ps-2">
                    <h3 class="m-0">
                        {{$toy->name}}
                    </h3>
                </div>
                <div class="product-price text-primary ps-2">{{"$" . number_format($toy->price, 0, ',', '.') }}</div>

                @if ($toy->stock)
                    <div class="btn-group d-flex justify-content-center mb-4">
                        <button class="btn btn-outline-gray text-capitalize rounded-pill me-2 btn-sm"
                            @auth
                                data-bs-toggle="modal"
                                data-bs-target="#addToCart{{$toy->id}}"
                            @else
                                data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasLogin"
                            @endauth >Add to cart +
                        </button>

                        <button href="" class="btn btn-outline-info text-capitalize rounded-pill btn-sm"
                            @auth
                                data-bs-toggle="modal"
                                data-bs-target="#buyNow{{$toy->id}}"
                            @else
                                data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasLogin"
                            @endauth >Buy Now!
                        </button>
                    </div>
                @else
                    <div class="d-flex justify-content-center mb-4">
                        <span class="text-danger">Out of Stock</span>
                    </div>
                @endif

            </div>

            <!-- Modal  View -->
            <div class="modal fade" id="staticBackdrop{{$toy->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$toy->name}}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex justify-content-center">
                            <img src="{{ $toy->image ? asset('img/' . $toy->image) : 'https://placehold.co/400/orange/white?text=Toy' }}" alt="toy" class="img-fluid" style="max-height:400px; max-width: 300px;">
                        </div>
                        <div class="modal-footer flex-column align-items-start">
                            <ul class="list-unstyled">
                                <li><strong>Stock:</strong>
                                    <h5>{{$toy->stock}}</h5>
                                </li>
                                <li><strong>Category:</strong>
                                    <h5>{{$toy->category->name}}</h5>
                                </li>
                                <li><strong>Price:</strong>
                                    <h5>
                                        {{"$" . number_format($toy->price, 0, ',', '.')}}
                                    </h5>
                                </li>
                                <li><strong>Description:</strong>
                                    <h5>
                                        {{$toy->description}}
                                    </h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Add to Cart -->
            <div class="modal fade" id="addToCart{{$toy->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$toy->name}}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="{{route('order_toy', $toy)}}" method="GET">
                                @csrf
                                <div class="input-group">
                                    <input type="number" class="form-control" id="productQuantity" name="quantity" min="1" required>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Buy Now -->
            <div class="modal fade" id="buyNow{{$toy->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel"> Apakah ingin membeli sebuah {{$toy->name}} ?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <div class="d-flex justify-content-center">
                                <a  href="{{route('buy_toy', $toy)}}" class="btn btn-primary">Yes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            </div>
            @endforeach

      </div>
    </div>
  </section>
