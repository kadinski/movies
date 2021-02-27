@extends('layouts.main')

@section('content')

    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <img src="{{ $movie['poster_path'] }}" alt="poster"  class="w-64 lg:w-96">
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{ $movie['title'] }}</h2>

                <div class="flex flex-wrap items-center text-gray-400 text-sm">
                    <svg class="fill-current text-yellow-500 w-4 mt-1" viewBox="0 0 20 20"><g data-name="Layer 2">
                        <path d="M0,0.054V20h21V0.054H0z
                         M15.422,18.129l-5.264-2.768l-5.265,2.768l1.006-5.863L1.64,8.114l5.887-0.855
                        l2.632-5.334l2.633,5.334l5.885,0.855l-4.258,4.152L15.422,18.129z" data-name="star" /></g></svg>
                        <span class="ml-1">{{ $movie['vote_average']  }}</span>
                        <span class="mx-2">|</span>
                        <span>{{($movie['release_date']) }}</span>
                    <span class="mx-2">|</span>
                    <span>  
                        {{ $movie['genres'] }}
                        {{-- @foreach ($movie['genres'] as $genre)
                        {{$genre['name']}}@if(!$loop->last), @endif
                        @endforeach --}}
                    </span>
                </div>

                <p class="text-gray-300 mt-8">
                   {{$movie['overview']}}
                </p>
                
                <div class="mt-12">
                    <h4 class="text-white font-semibold">Featured Cast</h4>
                    <div class="flex mt-4">

                        @foreach ($movie['crew'] as $crew)
                            {{-- @if($loop->index <3 ) premesteno kako 'crew' vo MovieViewModel --}}
                            <div class="mr-8">
                                <div>{{ $crew['name']}}</div>
                                <div class="text-sm text-gray-400">{{ $crew['job'] }}</div>
                            </div>
                            {{-- @else
                             @break
                            @endif --}}
                        @endforeach
                      
                    <div>                            
                </div>
            </div>
        
             <div x-data="{ isOpen: false }" >
                @if(count($movie['videos']['results']) >0)

                <div class="mt-12">
                    <button 
                    @click="isOpen = true"
                    href="https://youtube.com/watch?v={{ $movie['videos']['results'][0]['key'] }}" 
                    class="flex inline-flex item-center bg-yellow-500 text-gray-900 rounded font-semibold 
                    px-5 py-4 hover:bg-yellow-600 transition ease-in-out duration-150">
                        <svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/>
                            <path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48
                            10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                            <span class="ml-2">Play Trailer</span>
                    </button>
                </div>
              @endif

              <template x-if="isOpen">  {{--  za da go stopira videoto pri klikanje na x --}}
              <div
                    style="background-color: rgba(0,0,0,.5);"
                    class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                   
                    >                    
                    <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                        <div class="bg-gray-900 rounded">
                            <div class="flex justify-end pr-4 py-2">
                                <button
                                    @click="isOpen = false"
                                 class="text-3xl leading-none hover:text-gray-300">&times;</button>
                            </div>
                            <div class="modal-body px-8 py-8">

                                <div class="responsive-container overflow-hidden relative" style="padding-top:56.25%">
                                <iframe width="650" height="315" class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                 src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}" style="boreder:0;" 
                                 allow="autoplay; encrypted-media" allowfullscreen
                                  ></iframe>
                                </div>

                            </div>
                        </div>
                    </div>
              </div>
              </template>
            </div>



            </div>
        </div>
    </div>  {{-- end movie info  --}}

    <div class="movie-cast border-b border-gray-800">
        <div class="container-mx-auto px-20 py-16">
             <h2 class="text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-20">

                @foreach ($movie['cast'] as $cast)
                         <div class="mt-8">
                        <a href="{{route('actors.show', $cast['id']) }}">
                        <img src="{{'https://image.tmdb.org/t/p/w300'.$cast['profile_path']}}" 
                        alt="actor" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                        <div class="mt-2">
                           <a href="{{route('actors.show', $cast['id']) }}" class="text-lg mt-2 hover:text-gray-300">{{ $cast['name'] }}</a>
                           <div class="text-sm text-gray-400">
                            {{ $cast['character'] }}
                           </div>
                        </div>
                    </div>
                   
                @endforeach
            </div>
        </div>
    </div>
    




         <div class="movie-images" x-data="{ isOpen: false, image: ''}">
            <div class="container mx-auto px-4 py-16">
                <h2 class="text-4xl font-semibold">Images</h2>
                 <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 gap-8">

                    @foreach ($movie['images'] as $image)
                      
                            <div class="mt-8">
                                <a
                                    @click.prevent="
                                    isOpen = true
                                    image='{{'https://image.tmdb.org/t/p/original'.$image['file_path']}}'
                                    " 
                                 href="#">
                                    <img src="{{'https://image.tmdb.org/t/p/w500'.$image['file_path']}}" 
                                alt="image1" class="hover:opacity-75 transition ease-in-out duration-150">
                                </a>
                            </div>
                            
                    @endforeach
            </div>

            <div
                style="background-color: rgba(0, 0, 0, .5);"
                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                x-show="isOpen"
            >
                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end pr-4 pt-2">
                            <button
                                @click="isOpen = false"
                                @keydown.escape.window="isOpen = false"
                                class="text-3xl leading-none hover:text-gray-300">&times;
                            </button>
                        </div>
                        <div class="modal-body px-8 py-8">
                            <img :src="image" alt="poster">
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>      



@endsection