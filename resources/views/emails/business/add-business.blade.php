@slot('header')
@component('mail::header', ['url' => 'https://www.420finder.net'])
{{ config('app.name') }}
@endcomponent
@endslot

@component('mail::message')
# Dear {{ $business->first_name }} {{ $business->last_name }}

Your business has been created and waiting for admin approval!

## Business Info

Business Name: {{ $business->business_name }} <br>
Business Type: {{ $business->business_type }} <br>
Business Phone: {{ $business->phone_number }} <br>
Business Country: {{ $business->country }} <br>
Business City: {{ $business->city }} <br>
Business State / Province: {{ $business->state_province }} <br>
Business Address: {{ $business->address_line_1 }} <br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
