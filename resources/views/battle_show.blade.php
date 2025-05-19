@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Batalla</h1>

<form action="{{ route('battle.fight') }}" method="POST">
  @csrf
  <button type="submit" class="btn">Luchar</button>
</form>
@endsection