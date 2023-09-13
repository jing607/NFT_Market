@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-5">Ma Collection...</h1>
    <div class="row">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
    <div class="row">
        @if(empty($nfts))
            <p>Pas de nft trouvés...</p>
        @else
            @foreach ($nfts as $nft)
                    <div class="col-sm-4 mb-4">
                        <a href="{{ route('nft.detail', ['id' => $nft->id]) }}">
                            <div class="card nft-card">
                                <div class="card-header fw-bold">{{ $nft->title }}</div>

                                <div class="card-body d-flex flex-column justify-content-between">
                                    <img class="img-fluid" src="{{ asset($nft->image) }}" alt="nft">
                                    <div class="mt-3 d-flex flex-row justify-content-between align-items-end">
                                        <div class="fw-bold">artiste: {{ $nft->artist }}</div>
                                        <a href="{{ route('user.collection.remove', ['id'=> $nft->id]) }}" class="btn btn-warning">Vendre</a>
                                        <div class="fw-bold">{{ $nft->price }} ETH.</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
            @endforeach

        @endif
    </div>
</div>

@endsection
