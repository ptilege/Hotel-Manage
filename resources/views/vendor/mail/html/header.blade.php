@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<div style="text-align: center; background-color: #00427F; padding: 10px; border-radius: 10px;">
        <img src="https://roomista.com/images/logo.png" alt="Roomista Logo" style="max-width: 150px;">
    </div>
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
