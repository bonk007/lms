@props([
    'uid' => null
])

@php
    $url = "https://customer-vfw6arr5ungnr1ac.cloudflarestream.com/".$uid."/iframe?poster=https%3A%2F%2Fcustomer-vfw6arr5ungnr1ac.cloudflarestream.com%2F".$uid."7%2Fthumbnails%2Fthumbnail.jpg%3Ftime%3D%26height%3D600";
@endphp
<iframe
    src="{{ $url }}"
    loading="lazy"
    style="border: none; width: 100%; height: 100%"
    allow="accelerometer; gyroscope; autoplay; encrypted-media; picture-in-picture;"
    allowfullscreen="true"
></iframe>
