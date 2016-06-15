@extends('layouts.base', [
    'title' => 'bau'
])
@section('content')
    <bills-page></bills-page>
@endsection

@section('scripts-before-app.js')
    {{-- <script
    			  src="https://code.jquery.com/jquery-2.2.4.min.js"
    			  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
    			  crossorigin="anonymous"></script>
                  <script src="http://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script> --}}

@endsection
@section('scripts-after-app.js')
@endsection
