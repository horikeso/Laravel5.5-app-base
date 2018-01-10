{{-- Illuminate\Mail\resources\views\html message.blade.php --}}
@component('mail::message')

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
            $color = 'green';
            break;
        case 'error':
            $color = 'red';
            break;
        default:
            $color = 'blue';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Subcopy --}}
@isset($actionText)
@component('mail::subcopy')
[{{ $actionUrl }}]({{ $actionUrl }})
@endcomponent
@endisset
@endcomponent

