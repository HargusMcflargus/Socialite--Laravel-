<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>
    
    <h2 class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-2xl pt-12 pb-0">Recent Posts</h2>

    @foreach( $posts as $post )
        <div class="py-6" x-data="{ active: false }">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 text-gray-900"> 
                        <div class="grid grid-cols-4">
                            <div class="col-span-3">
                                <h1 class="text-xl p-2 pb-0">{{ $post['userDisplayName'] }}</h1>
                                <p class="text-gray-500 px-2 text-sm pb-2">{{ date('M d Y - g:i a', strtotime( $post['created_at'] ))   }} </p>
                            </div>
                            <div class="col-span-1 gap-4 content-end self-center flex flex-row justify-self-end">
                                <button @click="active = true" x-show="!active" class="rounded px-2 py-1 shadow border border-slate-200 hover:border-cyan-500">
                                    <x-edit-logo />
                                </button>
                                <form action="{{ route('removePost', [ 'post' => $post ]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="rounded px-2 py-1 shadow border border-slate-200 hover:border-red-500">
                                        <x-delete-trash />
                                    </button>
                                </form>
                            </div>
                        </div>
                        <hr>
                        <form action="{{ route('updatePost', [ 'postID' => $post ]) }}" method="post" class="w-full flex flex-row gap-4">
                            @csrf
                            @method('put')
                            <input class="w-full focus:ring-1 rounded px-4 py-2" :class="active ? 'border' : 'border-0'" type="text" class="p-2" :readonly="!active" value="{{$post['content']}}" name="content" id="content">
                            <button x-show="active" class="shrink px-4 rounded px-2 py-1 shadow border border-slate-200 hover:border-cyan-500">
                                <x-save-logo />
                            </button>
                        </form>
                        @if( $errors->any() )
                            @foreach( $errors->all() as $error )
                                <p class="text-red-600">*{{ $error }} </p>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
