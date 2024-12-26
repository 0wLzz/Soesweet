@extends('admin.admin')

@section('content')

    <div class="flex-column table-responsive">

        <!-- Tab Navigation -->
        <ul class="nav nav-tabs justify-content-evenly">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#total-sales-year">Total Penjualan Tahunan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#total-sales-month">Total Penjualan Bulanan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#best-seller">Penjualan Terlaris</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#user-purchases">Pembelian User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#history">Sejarah Pembelian</a>
            </li>
        </ul>

        <div class="tab-content mt-4">
            <!-- Total Sales Tab -->
            <div id="total-sales-year" class="tab-pane fade show active">
                @if ($admin->id === 1)
                    <!-- Total Sales by Year -->
                    <h1 class="fw-bold fs-1">Penjualan Tahunan</h1>
                    <table class="table table-striped" style="table-layout: fixed;">
                        <thead>
                            <tr>
                                <th>Tahun</th>
                                <th>Total (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salesByYear as $sale)
                                <tr>
                                    <td>{{ $sale->year }}</td>
                                    <td>Rp {{ number_format($sale->total_sales, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h1>Anda Tidak Bisa Mengakses ini</h1>
                @endif
            </div>

            <div id="total-sales-month" class="tab-pane fade">
                @if ($admin->id === 1)
                    <!-- Total Sales by Month -->
                    <h1 class="fw-bold fs-1">Penjualan Bulanan</h1>
                    <table class="table table-striped" style="table-layout: fixed;">
                        <thead>
                            <tr>
                                <th>Bulan</th>
                                <th>Total (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salesByMonth as $sale)
                                <tr>
                                    <td>{{ $sale->month }}</td>
                                    <td>Rp {{ number_format($sale->total_sales, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h1>Anda Tidak Bisa Mengakses ini</h1>
                @endif
            </div>

            <!-- Best Seller Tab -->
            <div id="best-seller" class="tab-pane fade">

                @if ($admin->id === 1)
                    <h3>Best Seller</h3>
                    <table class="table table-hover table-striped text-center">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Rank</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Total Sold</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $rank = 1;
                            @endphp
                            @foreach ($bestSellers as $item)
                            <tr style="vertical-align: middle">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td class="text-center">
                                    <img src="{{ $item->product->image ? asset('img/' . $item->product->image) : 'https://placehold.co/400/orange/white?text=Soes' }}" alt="food-image">
                                </td>
                                <td>{{ $item->product->name ?? 'N/A' }}</td>
                                <td>{{ $item->product->category->name ?? 'N/A' }}</td>
                                <td>{{ $item->total_sold }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h1>Anda Tidak Bisa Mengakses ini</h1>
                @endif
            </div>

            <!-- User Purchases Tab -->
            <div id="user-purchases" class="tab-pane fade">
                <h3>User Purchases</h3>
                <table class="table table-hover table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Pembeli</th>
                            <th scope="col">Tanggal Pembelian</th>
                            <th scope="col">Status</th>
                            <th scope="col">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $headerId => $details)
                            @php
                                $invoiceHeader = $details->first()->invoiceHeader;
                            @endphp
                            @if ($invoiceHeader->status === 'Proses')
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $invoiceHeader->user->name ?? 'Unknown User' }}</td>
                                    <td>{{ $invoiceHeader->created_at->format('d-m-Y') }}</td>
                                    @if ($invoiceHeader->status === 'Diterima')
                                        <td class="text-success">{{ $invoiceHeader->status }}</td>
                                    @elseif ($invoiceHeader->status === 'Cancel')
                                        <td class="text-danger">{{ $invoiceHeader->status }}</td>
                                    @else
                                        <td>{{ $invoiceHeader->status }}</td>
                                    @endif
                                    <td>
                                        <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#InvoiceModal{{ $headerId }}">
                                            View Details
                                        </button>

                                        <!-- Modal for each Invoice Header -->
                                        <div class="modal fade" id="InvoiceModal{{ $headerId }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">


                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5">Invoice Details for Header ID: {{ $headerId }}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="d-flex justify-content-evenly">
                                                            <p><strong>Admin:</strong> {{ $invoiceHeader->admin->name ?? 'Unknown Admin' }}</p>
                                                            <p><strong>User:</strong> {{ $invoiceHeader->user->name ?? 'Unknown User' }}</p>
                                                            <p><strong>Alamat:</strong> {{ $invoiceHeader->user->address ?? 'Unknown User' }}</p>
                                                        </div>
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>Product</th>
                                                                    <th>Quantity</th>
                                                                    <th>Price</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($details as $detail)
                                                                <tr>
                                                                    <td>{{ $detail->product->name }}</td>
                                                                    <td>{{ $detail->quantity }}</td>
                                                                    <td>Rp {{ number_format($detail->product->price, 0, ',', '.') }}</td>
                                                                </tr>
                                                                @endforeach
                                                                <tr>
                                                                    <td colspan="2" class="fw-bold">Total</td>
                                                                    <td>Rp {{ number_format($invoiceHeader->total_price, 0, ',', '.') }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer justify-content-center w-100">
                                                        <form id="updateStatusForm" method="POST" action="{{route('update_status', $invoiceHeader)}}">
                                                            @csrf
                                                            <input type="hidden" value="{{$admin->id}}" name="admin_id">
                                                            <div class="d-flex">
                                                                <div class="mb-3 me-3">
                                                                    <label for="status" class="form-label">Status</label>
                                                                    <select class="form-select" id="status" name="status" required>
                                                                        <option value="Diterima">Diterima</option>
                                                                        <option value="Cancel">Cancel</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3 me-3">
                                                                    <label for="status" class="form-label">Reason Of Canceling</label>
                                                                    <input type="text" name="reason_cancel">
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- History Tab -->
            <div id="history" class="tab-pane fade">
                <h3>User Purchases</h3>
                <table class="table table-hover table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Pembeli</th>
                            <th scope="col">Tanggal Pembelian</th>
                            <th scope="col">Status</th>
                            <th scope="col">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $headerId => $details)
                            @php
                                $invoiceHeader = $details->first()->invoiceHeader;
                            @endphp
                            @if ($invoiceHeader->status !== 'Proses')
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $invoiceHeader->user->name ?? 'Unknown User' }}</td>
                                <td>{{ $invoiceHeader->created_at->format('d-m-Y') }}</td>
                                @if ($invoiceHeader->status === 'Diterima')
                                    <td class="text-success">{{ $invoiceHeader->status }}</td>
                                @elseif ($invoiceHeader->status === 'Cancel')
                                    <td class="text-danger">{{ $invoiceHeader->status }}</td>
                                @else
                                    <td>{{ $invoiceHeader->status }}</td>
                                @endif
                                <td>
                                    <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#InvoiceModal{{ $headerId }}">
                                        View Details
                                    </button>

                                    <!-- Modal for each Invoice Header -->
                                    <div class="modal fade" id="InvoiceModal{{ $headerId }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">


                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5">Invoice Details for Header ID: {{ $headerId }}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="d-flex justify-content-evenly">
                                                        <p><strong>Admin:</strong> {{ $invoiceHeader->admin->name ?? 'Unknown Admin' }}</p>
                                                        <p><strong>User:</strong> {{ $invoiceHeader->user->name ?? 'Unknown User' }}</p>
                                                        <p><strong>Alamat:</strong> {{ $invoiceHeader->user->address ?? 'Unknown User' }}</p>
                                                    </div>
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Product</th>
                                                                <th>Quantity</th>
                                                                <th>Price</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($details as $detail)
                                                            <tr>
                                                                <td>{{ $detail->product->name }}</td>
                                                                <td>{{ $detail->quantity }}</td>
                                                                <td>Rp {{ number_format($detail->product->price, 0, ',', '.') }}</td>
                                                            </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td colspan="2" class="fw-bold">Total</td>
                                                                <td>Rp {{ number_format($invoiceHeader->total_price, 0, ',', '.') }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div>
                                                        <p>Reason for Canceling: <b>{{$invoiceHeader->cancel}}</b></p>
                                                        <p>Review: <b> {{$invoiceHeader->review}} </b></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
@endsection

@section('scripts')
@endsection
