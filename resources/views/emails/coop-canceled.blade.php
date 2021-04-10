@extends('emails.email-master')
@section('em-body')

<p>Hi! <b>{{$coop->owner->name}}</b></p>

<p>The Coop <b>{{$coop->name}}</b> has been canceled because it has expired on {{Carbon\Carbon::parse($coop->expiration_date)->format('m/d/Y')}} </p>


@endsection