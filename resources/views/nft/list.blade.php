@extends('layouts.app')


@section('content')
<main class="container">
    <span class="nftDetail-container">
        <div class="nftDetail-img">
            <img class="" src="{{ asset($nft->image) }}" alt="nft">
        </div>

        <section>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                <h3 class="NftDetail-title">Title</h3>
                <span class=""><h3>{{ $nft->title }}</h3></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                <p class="NftDetail-title">Artist</p>
                <span class=""><p>{{ $nft->artist }}</p></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                <p class="NftDetail-title">Description</p>
                <span class=""><p>{{ $nft->description }}</p></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <p class="NftDetail-title">Contrat</p>
                    <span class=""><a href="{{ $nft->contrat }}">Contrat Url</a></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <p class="NftDetail-title">Standard_token</p>
                    <span class=""><p>{{ $nft->standard_token }}</p></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <p class="NftDetail-title">Price</p>
                    <span class=""><p>{{ $nft->price }} ETH</p></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <p class="NftDetail-title">Category</p>
                    <span class=""><p>{{ $nft->category_id }}</p></span>
                </li>

                @if($owner)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <p class="NftDetail-title">Propriétaire</p>
                        <span class="">
                            <p>
                                {{ $owner->name }} (<a href="mailto:{{ $owner->email }})">{{ $owner->email }}</a>)
                            </p>
                        </span>
                    </li>
                @endif

                @if($canBuy)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <p class="NftDetail-title"></p>
                        <a href="{{ route('user.collection.add', ['id'=> $nft->id]) }}" class="btn btn-primary">Buy</a>
                    </li>
                @endif
            </ul>

            @auth
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <h4 class="NftDetail-title">Wallet</h4>
                        <span class=""><h5>{{ auth()->user()->wallet }} ETH</h5></span>
                    </li>
                </ul>
            @endauth

        </section>
    </span>
</main>
@endsection
