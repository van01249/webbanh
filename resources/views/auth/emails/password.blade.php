
Nhấn vào đường dẫn này để đổi mật mới<br>
<a href="{{ $link = url('password/reset' ,$token).'?email='.urlencode($user->getEmailForPasswordReset()) }}">{{ $link }}</a>