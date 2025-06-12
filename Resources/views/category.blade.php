@extends('layouts.app')

@section('content')
<category-component></category-component>
@endsection

@section('script')
    <script src="{{ asset('js/store.js') }}" defer></script>
@endsection
