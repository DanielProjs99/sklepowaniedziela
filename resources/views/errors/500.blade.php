<div class="content">
    <div class="title">Wystąpił błąd.</div>

    @if(app()->bound('sentry') && !empty(Sentry::getLastEventID()))
        <div class="subtitle">Kod błędu: {{ Sentry::getLastEventID() }}</div>
    @endif

    <a href="{{url('/')}}">Przejdź na stronę główną</a>
</div>