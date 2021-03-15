@props(['errors'])

@php
  if(session('state') == 'success') $alert_state = 'bg-green-500';
  elseif(session('state') == 'info') $alert_state = 'bg-blue-500';
  elseif(session('state') == 'warning') $alert_state = 'bg-yellow-500';
  elseif(session('state') == 'danger') $alert_state = 'bg-red-500';
  else $alert_state = '';
@endphp

@if(session()->has('message'))
  <alert-notification state="{{ $alert_state }}" message="{{ session('message') }}" redirect="{{ session('redirect') }}" />
@endif

@if ( $errors->any() )
  <div class="mt-8 container mx-auto px-4 xl:px-8 py-2 xl:py-4 bg-red-500 text-white rounded text-sm md:text-base" role="alert">

    <div class="flex items-center">
      <x-svg.icons type="alert" />
      <span class="ml-2 text-white font-semibold">Alert!</span>
    </div>

    <ul class="mt-2 list-disc list-inside text-sm text-gray-100">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
