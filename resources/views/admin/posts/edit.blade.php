@extends('layouts.base')

@section('pageTitle')
    Modifica: {{$post->title}}
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
@endif

    <form action="{{route('admin.posts.update', ['post' =>$post->id])}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{$post->title}}">
        </div>
        <div class="form-group">
            <label for="date">Data</label>
            <input type="date" class="form-control" name="date" id="date" placeholder="Date" value="{{$post->date}}">
        </div>
        <div class="form-group">
            <label for="content">Contenuto</label>
            <textarea type="text" class="form-control" name="content" id="content" cols="30" rows="10" placeholder="Content">{{$post->content}}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Immagine</label>
            <input type="text" class="form-control" name="image" id="image" placeholder="Image"  value="{{$post->image}}"">
        </div>
        <div class="form-check form-check-inline">
            <input type="checkbox" class="form-check-input" name="published" id="published" {{$post->published ? 'checked' : ''}}>
            <label for="published" class="form-check-label">Pubblicato</label>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Crea</button>
        </div>
      </form>
@endsection