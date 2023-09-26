<x-app-layout>
    <x-slot name="header">
        @if( Auth::check() ) 
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        @else
            <a href="{{ route('login') }}" class="font-semibold text-gray-900 hover:text-gray-500 hover:underline focus:outline-0 focus:rounded-sm focus:outline-red-500">Log in</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-900 hover:text-gray-500 hover:underline focus:outline-0 focus:rounded-sm focus:outline-red-500">Register</a>
            @endif
        @endif
    </x-slot>

    @if( Auth::check() )
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form action="{{ route('createPost') }}" method="post" class="flex gap-2 flex-col">
                            @csrf
                            <input placeholder="Write Something..." type="text" name="content" id="content" class="w-full rounded focus:py-4 transition-all px-4 focus:shadow duration-300 focus:ring-0 border-t-0 border-l-0 border-r-0">
                            <button class="self-end shadow px-4 py-2 rounded-xl border text-slate-200 bg-cyan-500 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-blue-500 transition-all duration-300">Post</button>
                            @if( $errors->any() )
                                @foreach( $errors->all() as $error )
                                    <p class="text-red-600">*{{ $error }} </p>
                                @endforeach
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    <h2 class="max-w-7xl mx-auto pt-6 sm:px-6 lg:px-8 text-2xl">Recent Posts</h2>

    @foreach( $posts as $post )
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 text-gray-900"> 
                        <h1 class="text-xl p-2 pb-0">{{ $post['userDisplayName'] }}</h1>
                        <p class="text-gray-500 px-2 text-sm pb-2">{{ date('M d Y - g:i a', strtotime( $post['created_at'] ))   }} </p>
                        <hr>
                        <p class="text-slate-700 p-4"> {{$post['content']}} </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
