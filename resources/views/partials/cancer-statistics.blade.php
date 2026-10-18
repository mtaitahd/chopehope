<div class="cancer-stat-grid" aria-label="Childhood cancer figures from Tumaini la Maisha">
    @foreach(config('cancer_statistics.items') as $statistic)
        <article class="cancer-stat">
            <strong>{{ $statistic['value'] }}</strong>
            <p>{{ $statistic['label'] }}</p>
            <a href="{{ $statistic['source_url'] }}" target="_blank" rel="noopener">{{ $statistic['source_label'] }} <span aria-hidden="true">↗</span></a>
        </article>
    @endforeach
</div>
<p class="cancer-stat-note">National estimates and treatment figures reported by Tumaini la Maisha (TLM). Sources reviewed in October 2026.</p>
