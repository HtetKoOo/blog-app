@extends('user.layouts.app')
@section('music')
<div id="root"></div>
@endsection

@section('scripts')
<script>
    const bladeMusic = @json($music);
</script>
@viteReactRefresh
@vite(['resources/js/Music/music.jsx'])
@endsection