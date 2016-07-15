@extends('pages.auth.base', [
    'pageTitle' => 'Conectează-te - Nova Manager',
    'firstText' => 'Conectează-te',
    'shortDescription' => 'Pentru a folosi Nova trebuie să vă conectaţi cu contul dumneavoastră.',
    'registerButton' => true,
]);
@section('content')
    <login-page></login-page>
@endsection
