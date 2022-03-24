@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">6.1 Active & Verified Users</div>
                <div class="card-body">{{ $active_users }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">6.2 Active + Attached Products</div>
                <div class="card-body">{{ $users_with_product }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">6.3 Active Products</div>
                <div class="card-body">{{ $active_products }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">6.4 Active Products without User</div>
                <div class="card-body">{{ $active_products_without_user }}</div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">6.5 Sum of Active Attached Products</div>
                <div class="card-body">{{ $sum_of_attached_products }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">6.6 Summarized Price of Attached Products</div>
                <div class="card-body">{{ $summarized_of_attached_products }}</div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">6.7 Summarized Prices of Active Products Per User</div>
                <div class="card-body">
                    @foreach($summarized_per_user as $val)
                        <ul>
                            <li>{{ $val->user->name ?? '' }} {{ $val->total }} <br> </li>
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">6.8 Exchange Rates for USD and RON based on Euro</div>
                <div class="card-body">
                    <ul>
                    @foreach($exchange_response as $key => $val)
                        @if($key == 'USD' || $key == 'RON')
                            <li> {{ $key.': '.$val }} </li>
                        @endif
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
