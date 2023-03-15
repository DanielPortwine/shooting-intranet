<x-mail::message>
# Hi {{ $user }},

Your membership is due for renewal. Please see below the list of your current packages and amounts due.

<x-mail::table>
| Package  | Price    | Due      |
| :------: | :------: | :------: |
@foreach($payments as $payment)
| {{ $payment->package->name }} | £{{ $payment->price }} | {{ $payment->due_date->format('d/m/Y') }} |
@endforeach
</x-mail::table>

## Ways to pay:
### Bank Transfer

You can pay straight into our bank account using bank transfer. It can take up to 48hrs to verify your transfer so please only pay once and make sure you provide your reference. Use the following details:

Sort Code: XX-XX-XX

Account Number: XXXXXXXX

Reference: Super Admin

### Cash

You can pay in cash at the club.

### Card

You can pay online using your credit or debit card. Click below to do so.

<x-mail::button :url="route('membership')">
Pay Online
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
