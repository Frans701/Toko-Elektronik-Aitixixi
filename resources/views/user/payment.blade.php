@extends('layouts.template')
@section('content')
<section class="breadcrumb-section pb-1 pt-2">
    <div class="container">
        <ol class="breadcrumb">
            
            <h2 style="color:#0275d8" class="ml-5">Check Out</h2>
        </ol>
    </div>
</section>
    <div class="container mt-3">
        <section class="breadcrumb-section pt-4">
            <div class="col ml-5 mt-1 mb-3">
                <a href="{{ url()->previous() }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>  
            </div>
            <div class="container">
                <h5 class="ml-5">Produk Dipesan</h5>
            </div>
            <section class="product-page ml-5 mr-5 pb-3 pt-3">
                <div class="row mt-2">
                <div class="col-md-8">
                    <div class="card mb-4 shadow-sm">
                        <form action="{{route('ongkir')}}" method="get">
                            @csrf
                            <div class="table responsive">
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <td>Produk Dipesan</td>
                                            <td>Nama</td>
                                            <td>Harga Satuan</td>
                                            <td>Jumlah</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($chart as $charts)
                                        <tr>
                                            <td>
                                                <img src="assets/img/products/2.jpg" class="img-fluid" width="50">
                                            </td>
                                            <td>{{ $charts->products->product_name }}</td>
                                            <td>Rp. {{ number_format($charts->products->price) }}</td>
                                            <td align="center">{{ $charts->qty }}</td>
                                        </tr>       
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div>
                            @if ($transaction->status == "unpaid")
                            <h2 class="h6 text-center mb-4">Transfer Now</h2>
                            <!-- Timeout Countdown-->
                            <div class="countdown h4 justify-content-center py-3" data-countdown="{{ $transaction->timeout->format('m/d/Y h:m:s A') }}">
                                {{-- <div class="countdown-days">
                                    <span class="countdown-value">0</span>
                                    <span class="countdown-label text-muted">d</span>
                                </div> --}}
                                <div class="countdown-hours">
                                    <span class="countdown-value">0</span>
                                    <span class="countdown-label text-muted">h</span>
                                </div>
                                <div class="countdown-minutes">
                                    <span class="countdown-value">0</span>
                                    <span class="countdown-label text-muted">m</span>
                                </div>
                                <div class="countdown-seconds">
                                    <span class="countdown-value">0</span>
                                    <span class="countdown-label text-muted">s</span>
                                </div>
                            </div>
                        
                            <ul class="list-unstyled fs-sm pb-2 border-bottom">
                                <li class="d-flex justify-content-between align-items-center">
                                    <span class="me-2">Bank Name:</span>
                                    <span class="text-end">BCA (014)</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center">
                                    <span class="me-2">Account Number:</span>
                                    <span class="text-end">0402874774</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center">
                                    <span class="me-2">Account Name:</span>
                                    <span class="text-end">Luciae Furniture</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center">
                                    <span class="me-2">Total Amount:</span>
                                    <span class="text-end fw-bold">@currency($transaction->total)</span>
                                </li>
                            </ul>
                            <div class="@if($is_transfered) d-none @endif">
                                <small>Make sure the amount is correct. Then, save your transfer voucher</small>
                                <button wire:click="cancelOrder" class="btn btn-secondary d-block w-100 mt-3" type="button">Cancel Order</button>
                                <button wire:click="transfered" class="btn btn-primary d-block w-100 mt-2" type="button">Already
                                    Transferred</button>
                            </div>
                        
                            <div class="@if(!$is_transfered) d-none @endif">
                                <form wire:submit.prevent="savePayment">
                                    <div wire:ignore class="file-drop-area @error('proof_of_payment') is-invalid @enderror">
                                        <div class="file-drop-icon ci-cloud-upload"></div>
                                        <span class="file-drop-message">Drag and drop here to upload</span>
                                        <input wire:model="proof_of_payment" type="file" class="file-drop-input" accept="image/*">
                                        <button type="button" class="file-drop-btn btn btn-primary btn-sm">Or select file</button>
                                    </div>
                                    @error('proof_of_payment')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <button class="btn btn-primary d-block w-100 mt-2" type="submit">Confirm Transfer Voucher</button>
                                </form>
                            </div>
                            @endif
                        
                            @if ($transaction->status == "paid")
                            <h2 class="h4 text-center mb-4">Thank you</h2>
                            <p class="fs-sm mb-2">Your order has been placed and will be processed as soon as possible.</p>
                            <u class="fs-sm">You can now:</u>
                            <a class="btn btn-secondary d-block w-100 mt-3" href="{{ route('home') }}">Back to Shopping</a>
                            <a class="btn btn-primary d-block w-100 mt-3" href="{{ route('profile.orders') }}">Orders History</a>
                            @endif
                        
                            @if ($transaction->status == "admin_verified")
                            <h2 class="h4 text-center mb-4">Thank you</h2>
                            <p class="fs-sm mb-2">Your order has been <b>verified</b>. We are preparing the delivery of your order</p>
                            <u class="fs-sm">You can now:</u>
                            <a class="btn btn-secondary d-block w-100 mt-3" href="{{ route('home') }}">Back to Shopping</a>
                            <a class="btn btn-primary d-block w-100 mt-3" href="{{ route('profile.orders') }}">Orders History</a>
                            @endif
                        
                            @if ($transaction->status == "admin_deliver")
                            <h2 class="h4 text-center mb-4">Thank you</h2>
                            <p class="fs-sm mb-2">Your order is on its way. Your products will be deliver directly to your address</p>
                            <u class="fs-sm">You can now:</u>
                            <a class="btn btn-secondary d-block w-100 mt-3" href="{{ route('home') }}">Back to Shopping</a>
                            <a class="btn btn-primary d-block w-100 mt-3" wire:click.prevent="setArrived" href="#">Products Arrived</a>
                            @endif
                        
                            @if ($transaction->status == "expired")
                            <h2 class="h4 text-center mb-4">Order Failed!</h2>
                            <p class="fs-sm mb-2">Sorry, your payment was timeout. Please try to re-order the products.</p>
                            <u class="fs-sm">You can now:</u>
                            <a class="btn btn-primary d-block w-100 mt-3" href="{{ route('home') }}">Back to Shopping</a>
                            @endif
                        
                            @if ($transaction->status == "success")
                            <h2 class="h4 text-center mb-4">Thank you</h2>
                            <p class="fs-sm mb-2">Your order has been <b>finished</b>. Please rate our product in the left section</p>
                            <u class="fs-sm">You can now:</u>
                            <a class="btn btn-secondary d-block w-100 mt-3" href="{{ route('home') }}">Back to Shopping</a>
                            <a class="btn btn-primary d-block w-100 mt-3" href="{{ route('profile.orders') }}">Orders History</a>
                            @endif
                        
                            @if ($transaction->status == "canceled")
                            <h2 class="h4 text-center mb-4">Order Canceled!</h2>
                            <p class="fs-sm mb-2">This order was canceled. Please try to re-order the products.</p>
                            <u class="fs-sm">You can now:</u>
                            <a class="btn btn-primary d-block w-100 mt-3" href="{{ route('home') }}">Back to Shopping</a>
                            @endif
                        </div>
                    </div>
                </div>
                </div>
        </section>
    </div>

@endsection

<div>
    @if ($transaction->status == "unpaid")
    <h2 class="h6 text-center mb-4">Transfer Now</h2>
    <!-- Timeout Countdown-->
    <div class="countdown h4 justify-content-center py-3" data-countdown="{{ $transaction->timeout->format('m/d/Y h:m:s A') }}">
        {{-- <div class="countdown-days">
            <span class="countdown-value">0</span>
            <span class="countdown-label text-muted">d</span>
        </div> --}}
        <div class="countdown-hours">
            <span class="countdown-value">0</span>
            <span class="countdown-label text-muted">h</span>
        </div>
        <div class="countdown-minutes">
            <span class="countdown-value">0</span>
            <span class="countdown-label text-muted">m</span>
        </div>
        <div class="countdown-seconds">
            <span class="countdown-value">0</span>
            <span class="countdown-label text-muted">s</span>
        </div>
    </div>

    <ul class="list-unstyled fs-sm pb-2 border-bottom">
        <li class="d-flex justify-content-between align-items-center">
            <span class="me-2">Bank Name:</span>
            <span class="text-end">BCA (014)</span>
        </li>
        <li class="d-flex justify-content-between align-items-center">
            <span class="me-2">Account Number:</span>
            <span class="text-end">0402874774</span>
        </li>
        <li class="d-flex justify-content-between align-items-center">
            <span class="me-2">Account Name:</span>
            <span class="text-end">Luciae Furniture</span>
        </li>
        <li class="d-flex justify-content-between align-items-center">
            <span class="me-2">Total Amount:</span>
            <span class="text-end fw-bold">@currency($transaction->total)</span>
        </li>
    </ul>
    <div class="@if($is_transfered) d-none @endif">
        <small>Make sure the amount is correct. Then, save your transfer voucher</small>
        <button wire:click="cancelOrder" class="btn btn-secondary d-block w-100 mt-3" type="button">Cancel Order</button>
        <button wire:click="transfered" class="btn btn-primary d-block w-100 mt-2" type="button">Already
            Transferred</button>
    </div>

    <div class="@if(!$is_transfered) d-none @endif">
        <form wire:submit.prevent="savePayment">
            <div wire:ignore class="file-drop-area @error('proof_of_payment') is-invalid @enderror">
                <div class="file-drop-icon ci-cloud-upload"></div>
                <span class="file-drop-message">Drag and drop here to upload</span>
                <input wire:model="proof_of_payment" type="file" class="file-drop-input" accept="image/*">
                <button type="button" class="file-drop-btn btn btn-primary btn-sm">Or select file</button>
            </div>
            @error('proof_of_payment')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <button class="btn btn-primary d-block w-100 mt-2" type="submit">Confirm Transfer Voucher</button>
        </form>
    </div>
    @endif

    @if ($transaction->status == "paid")
    <h2 class="h4 text-center mb-4">Thank you</h2>
    <p class="fs-sm mb-2">Your order has been placed and will be processed as soon as possible.</p>
    <u class="fs-sm">You can now:</u>
    <a class="btn btn-secondary d-block w-100 mt-3" href="{{ route('home') }}">Back to Shopping</a>
    <a class="btn btn-primary d-block w-100 mt-3" href="{{ route('profile.orders') }}">Orders History</a>
    @endif

    @if ($transaction->status == "admin_verified")
    <h2 class="h4 text-center mb-4">Thank you</h2>
    <p class="fs-sm mb-2">Your order has been <b>verified</b>. We are preparing the delivery of your order</p>
    <u class="fs-sm">You can now:</u>
    <a class="btn btn-secondary d-block w-100 mt-3" href="{{ route('home') }}">Back to Shopping</a>
    <a class="btn btn-primary d-block w-100 mt-3" href="{{ route('profile.orders') }}">Orders History</a>
    @endif

    @if ($transaction->status == "admin_deliver")
    <h2 class="h4 text-center mb-4">Thank you</h2>
    <p class="fs-sm mb-2">Your order is on its way. Your products will be deliver directly to your address</p>
    <u class="fs-sm">You can now:</u>
    <a class="btn btn-secondary d-block w-100 mt-3" href="{{ route('home') }}">Back to Shopping</a>
    <a class="btn btn-primary d-block w-100 mt-3" wire:click.prevent="setArrived" href="#">Products Arrived</a>
    @endif

    @if ($transaction->status == "expired")
    <h2 class="h4 text-center mb-4">Order Failed!</h2>
    <p class="fs-sm mb-2">Sorry, your payment was timeout. Please try to re-order the products.</p>
    <u class="fs-sm">You can now:</u>
    <a class="btn btn-primary d-block w-100 mt-3" href="{{ route('home') }}">Back to Shopping</a>
    @endif

    @if ($transaction->status == "success")
    <h2 class="h4 text-center mb-4">Thank you</h2>
    <p class="fs-sm mb-2">Your order has been <b>finished</b>. Please rate our product in the left section</p>
    <u class="fs-sm">You can now:</u>
    <a class="btn btn-secondary d-block w-100 mt-3" href="{{ route('home') }}">Back to Shopping</a>
    <a class="btn btn-primary d-block w-100 mt-3" href="{{ route('profile.orders') }}">Orders History</a>
    @endif

    @if ($transaction->status == "canceled")
    <h2 class="h4 text-center mb-4">Order Canceled!</h2>
    <p class="fs-sm mb-2">This order was canceled. Please try to re-order the products.</p>
    <u class="fs-sm">You can now:</u>
    <a class="btn btn-primary d-block w-100 mt-3" href="{{ route('home') }}">Back to Shopping</a>
    @endif
</div>

@push('scripts')
<script>
    window.livewire.on('alert', param => {
        $('#' + param['type'] + "-toast .toast-body").html(param['message']);
        $('#' + param['type'] + "-toast").toast('show');
    });
</script>
@endpush
