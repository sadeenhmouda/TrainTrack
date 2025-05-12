@extends('master')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/fallback.css') }}">
@endsection

@section('content')
  <div class="w-full h-[100vh] flex justify-center items-center bg-[#f4f4f4]">
    @include('fallbackpopup')  <!-- ✅ Fixed include -->
  </div>
@endsection

@section('scripts')
<script src="{{ asset('js/fallback.js') }}"></script>
<script>
  showFallbackModal(); // ✅ Always trigger in this test view
</script>
@endsection
