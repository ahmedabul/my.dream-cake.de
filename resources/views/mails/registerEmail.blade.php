@component('mail::message')
# SARAHJOLIE 

Thank you for signing up for Sarahjolie!
Please verify your email address by clicking the button below.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/register/completeRegister'])
Confirm my account
@endcomponent

Danke,<br>
SARAHJOLIE
@endcomponent
