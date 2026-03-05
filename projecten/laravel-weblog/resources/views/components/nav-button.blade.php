@props(['active' => false])

<a class="button {{ $active ? 'active' : ''}}" {{ $attributes }}>{{ $slot }}</a>