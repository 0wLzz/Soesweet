@extends('admin.admin')

@section('content')
    <div class="d-flex justify-content-center align-items-start flex-column gap-4 table-responsive">
        <div class="d-flex">
            <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{route('add_product')}}">
                + Add Product
            </a>
        </div>

        <div class="d-flex justify-content-center align-items-center gap-4">
            <a class="btn btn-outline-dark" href="{{route('admin_table')}}">All Categories</a>
            @foreach ($categories as $category)
                <a class="btn btn-outline-dark" href="{{ route('category_product', $category) }}"> {{ $category->name }} </a>
            @endforeach
        </div>

        <h3>Daftar Menu</h3>

        <!-- Search Bar on Far Right -->
        <form class="d-flex ms-auto" method="GET" action="{{route('search_product')}}">
            <div class="input-group" >
                <input name="search" class="form-control" type="search" placeholder="Search..." style="background: rgba(51, 45, 65, 0.16);">
                <button class="btn" type="submit" style="background: rgba(51, 45, 65, 0.16);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                </button>
            </div>
        </form>

        <table class="table table-hover table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $num = 1;
                @endphp
                @foreach ($products as $product)
                    <tr style="vertical-align: middle">
                        <th scope="row">{{$num++}}</th>
                        <td class="text-center">
                            <img src="{{ $product->image ? asset('img/' . $product->image) : 'https://placehold.co/400/orange/white?text=Soes' }}" alt="food-image">
                        </td>
                        <td>
                            {{$product->name}}
                        </td>
                        <td>{{$product->category->name}}</td>
                        <td>{{"Rp." . number_format($product->price, 0, ',', '.')}}</td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center gap-4">
                                <a class="btn btn-outline-primary" href="{{route('edit_product', $product)}}">
                                    <i class="bi bi-pen"></i>
                                </a>

                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#Modal{{$num}}">
                                    <i class="bi bi-trash"></i>
                                </button>

                                <div class="modal fade" id="Modal{{$num}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 justify-content-center" id="exampleModalLabel">Apakah {{$product->name}} ingin dihapus?</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-footer justify-content-center">
                                          <form action="{{ route('delete_product', $product) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    Iya
                                                </button>
                                            </form>
                                        </div>
                                      </div>
                                    </div>
                                </div>

                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection


