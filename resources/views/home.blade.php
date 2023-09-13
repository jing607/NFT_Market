
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center flex-row mb-4">
        @foreach ($cats as $cat)
            <a href="{{ route('home') . '/cat/'. $cat->id }}" class="btn {{ $catID === $cat->id ? 'btn-primary' : 'btn-secondary' }}  d-inline ms-2">{{ ucfirst($cat->title) }}</a>
        @endforeach

        @if($catID !== 0)
            <a href="{{ route('home') }}" class="btn btn-secondary d-inline ms-2">Tous</a>
        @endif
    </div>
</div>

<div class="container">
    <div class="row">
    @foreach ($nfts as $nft)
            <div class="col-sm-4 mb-4">
                <a href="{{ route('nft.detail', ['id' => $nft->id]) }}">
                    <div class="card nft-card ">
                        {{-- <div class="thumbnail"> --}}
                            <img class="card-img-top" src="{{ asset($nft->image) }}" alt="nft">
                            {{-- <div class="cover" ><a href="#">0</a></div>
                        </div> --}}

                        <div class="card-body  flex-column ">
                            <div class="card-title fw-bold">{{ $nft->title }}</div>
                            <div class="mt-3 d-flex flex-row justify-content-between align-items-end">
                                <div class="fw-bold">artist: {{ $nft->artist }}</div>
                                <div class="fw-bold">{{ $nft->price }} ETH.</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
    @endforeach
    </div>
</div>

@endsection
