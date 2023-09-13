@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Ajouter un Nft</h1>
    <p class="mb-5">
        <a href="{{ route('admin.nft.list') }}">
        <small>Liste des nft</small>
        </a>
    </p>
    <form method="POST" action="{{ route('admin.nft.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" name="title" id="title" class="form-control" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="artist" class="form-label">Artiste</label>
            <input type="text" name="artist" id="artist" class="form-control" required>
            @error('artist')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="contrat" class="form-label">Contrat</label>
            <input type="text" name="contrat" id="contrat" class="form-control" required>
            @error('contrat')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="standard_token" class="form-label">Standard Token</label>
            <select name="standard_token" id="standard_token" class="form-select" required>
                <option value="ERC-721">ERC-721</option>
                <option value="ERC-1155">ERC-1155</option>
                <option value="option3">ERC-998</option>
                <!-- Ajoutez d'autres options selon vos besoins -->
            </select>
            @error('standard_token')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Prix</label>
            <input type="text" name="price" id="price" class="form-control" required>
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control" required>
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Créer</button>
    </form>

</div>
@endsection
