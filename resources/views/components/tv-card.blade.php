{{-- @props(['movie' => $movie])
@props(['genres' => $genres]) --}}

<div class="mt-8">
    <a href="{{ route('tv.show', $tvshow['id']) }}">
        <img src="{{ $tvshow['poster_path'] }}" alt="poster" 
        class="hover:opacity-75 transition ease-in-out duration-150">
    </a>
    <div class="mt-2">
        <a href="{{ route('tv.show' , $tvshow['id']) }}" class="text-lg mt-2 hover:text-gray:300">{{ $tvshow['name'] }}</a>
        <div class="flex items-center text-gray-400 text-sm mt-1">
            <svg class="fill-current text-yellow-500 w-4 mt-1" viewBox="0 0 20 20"><g data-name="Layer 2">
                <path d="M0,0.054V20h21V0.054H0z
                M15.422,18.129l-5.264-2.768l-5.265,2.768l1.006-5.863L1.64,8.114l5.887-0.855
                l2.632-5.334l2.633,5.334l5.885,0.855l-4.258,4.152L15.422,18.129z" data-name="star" /></g></svg>
            <span class="ml-1">{{ $tvshow['vote_average'] }}</span>
            <span class="mx-2">|</span>
            <span>{{ $tvshow['first_air_date'] }}</span>
        </div>
        <div class="text-gray-400 text-sm">
           {{ $tvshow['genres'] }}
         
        </div>
    </div>
</div>
