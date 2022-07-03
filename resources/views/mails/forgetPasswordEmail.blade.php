@component('mail::message')
# SARAJOLIE

Um das neue Passwort zu bestätigen, klicken Sie bitte den folgenden Button

@component('mail::button', ['url' => 'http://127.0.0.1:8000/forgetPassword/completeForgetPassword'])
Bestätigen
@endcomponent
 
Danke,<br>
SARAJOLIE
@endcomponent
