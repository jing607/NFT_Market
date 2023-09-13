@extends('layouts.admin')

@section('content')
<div class="container">
    <h1><span class="fa-solid fa-user"></span>Liste des Utilisateurs</h1>
    <p class="mb-5">
        <a href="{{ route('admin.nft.list') }}">
            <small>Liste des Nfts</small>
        </a>
        
    </p>


    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Wallet</th>
                <th>NFT</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->wallet }} ETH</td>
                    <td>{{ $user->nftCount }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
