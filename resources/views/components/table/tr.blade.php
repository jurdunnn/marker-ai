@props(['onclick' => null])
<tr onclick="{{ $onclick }}" class="text-gray-500 bg-white border-b cursor-pointer group">
    {{ $slot }}
</tr>
