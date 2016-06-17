@extends('layouts.base', [
    'title' => 'Detalii factură'
])
@section('content')
    <bill-page bill-id="{{ $billId }}"></bill-page>
@endsection
