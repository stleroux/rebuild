{{-- @component('mail::message')

# Thank you for your message

<strong>Name :</strong>{{ $data['email'] }}
<br />
<strong>Subject :</strong>{{ $data['subject'] }}
<br />
<strong>Message :</strong>{{ $data['message'] }}

@endcomponent --}}

<h1>{{ $data['subject'] }}</h1>
<p><b>From : </b>{{ $data['email'] }}</p>
<p>{{ $data['message'] }}</p>
<br />
<table border="1" cellspacing="1" cellpadding="1" width="100%">
   <tr>
      <td>1</td>
      <td>2</td>
      <td>3</td>
   </tr>
   <tr>
      <td colspan="3">123</td>
   </tr>
</table>
