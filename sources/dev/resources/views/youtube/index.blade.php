@extends('layouts.app', ['activePage' => 'youtube', 'titlePage' => __('Youtube')])

@section('styles')
<link rel="stylesheet" href="{{ mix('css/pages/youtube.css') }}">
@endsection

@section('content')
<div class="content">
<button class='demo-youtube' id='demo-youtube'>api generate youtube</button>
</div>
@endsection
@section('scripts')
<script src="{{ mix('js/pages/youtube.js') }}"></script>
@endsection