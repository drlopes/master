@component('mail::message')
# New series "{{ $seriesName }}" added!

The series {{ $seriesName }}, 
with {{ $seasonsCount }} seasons and {{ $episodesCount }} episodes per season 
has been added.

Check it out here:
@component('mail::button', ['url' => route('seasons.index', ['series' => $seriesId, 'name' => $seriesName])])
    Series
@endcomponent
@endcomponent