<h3>Cześć Admin {{ config('app.display_name') }},</h3>
Właśnie otrzymałeś wiadomość od: {{ $name }}
<br>
Szczegóły poniżej: <br><br>
<b>Imię:</b> {{ $name }} <br>
<b>Email:</b> {{ $email }} <br>
<b>Wiadomość:</b> {{ $user_message }} <br><br>
Miłego dnia!!! <br>
Wysłano automatycznie z {{ config('app.display_name') }}
