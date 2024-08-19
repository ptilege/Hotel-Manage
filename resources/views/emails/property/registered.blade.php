<!-- resources/views/emails/property/registered.blade.php -->

@component('mail::message')
# Property Registration Successful

Property registration has been successfully completed. Thank you for choosing to partner with us.

@component('mail::button', ['url' => env('APP_URL') . '/admin'])
Click here to access your property
@endcomponent

Regards,<br>
Roomista Team
@endcomponent
