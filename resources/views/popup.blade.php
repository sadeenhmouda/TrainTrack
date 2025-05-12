@extends('summaryresults')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/popup.css') }}">
@endsection



@section('scripts')
<script src="{{ asset('js/popup.js') }}"></script>
<script>
  showFallbackModal(); // ✅ Always trigger in this test view
</script>
@endsection
