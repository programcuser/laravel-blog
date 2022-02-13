<h1>О блоге</h1>
<p>Эксперименты с Laravel</p>
<p>
    <ul>
        @foreach ($team as $member)
            <li>{{$member['name']}} is {{$member['position']}}</li>
        @endforeach
    </ul>
</p>