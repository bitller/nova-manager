@extends('layouts.base', [
    'title' => 'Detalii utilizator'
])
@section('content')
    <admin-center-page active="users" sub-section="user_details" user-id="{{ $userId }}"></admin-center-page>
@endsection
