@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Liste des NFTs</h1>
    <p class="mb-5">
        <a href="{{ route('admin.user.list') }}">
        <small>Liste des utilisateurs</small>
        </a>
    </p>
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
    <div class="row justify-content-end flex-row">
        <div class="col-sm-1 d-flex justify-content-end">
            <a href="{{ route('admin.nft.create') }}" class="btn btn-success fs-3"><i class="fa-solid fa-circle-plus"></i></a>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Artiste</th>
                <th>Propriétaire</th>
                <th>Prix</th>
                <th>Catégorie</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nfts as $nft)
                <tr>
                    <td>{{ $nft->title }}</td>
                    <td>{{ $nft->artist }}</td>
                    @if($nft->ownerName !== '--')
                        <td>{{ $nft->ownerName }} (<a href="mailto:{{ $nft->ownerEmail }}"><small>{{ $nft->ownerEmail }}</small></a>)</td>
                    @else
                        <td></td>
                    @endif
                    <td>{{ $nft->price }}</td>
                    <td>{{ ucfirst($nft->catName) }}</td>
                    @if($nft->ownerName !== '--')
                        <td></td>
                    @else
                        <td><a href="{{ route('admin.nft.destroy', ['id' => $nft->id]) }}" class="btn btn-danger del-btn"><span class="fa-solid fa-trash"></span></a></td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
