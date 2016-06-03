@extends('layouts.base', [
    'title' => 'Detalii client'
])
@section('content')
    <div id="client" content="{{ $clientId }}"></div>
    <client-page></client-page>
@endsection
