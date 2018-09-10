@extends('master')

@section('style')
	<style>
		body {
			background: #eee;
		}
	</style>
@stop

@section('content')
	Hello World!
	@include('footer')
@stop

@section('script')
	<script>
		alert('Hello Script! ^^/');
	</script>
@stop