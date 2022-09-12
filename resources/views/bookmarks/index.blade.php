@extends('layouts.app')

@section('container')
    <div class="pb-12 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grow flex flex-col mb-6 lg:mb-0 col-span-2 order-0 lg:order-1">
                <div class="bg-white border-b border-gray-200 grow">
                    <div class="flex flex-col p-6">
                        <div class="flex flex-col py-3">
                            <h2 class="text-2xl font-bold">{{ $bookmarks->total() }} {{ $bookmarks->total() == 1 ? 'Bookmark' : 'Bookmarks' }}</h2>
                        </div>

                        @if ($bookmarks->hasPages())
                            <div class="py-6 px-6 sm:px-0">
                                {{ $bookmarks->appends(request()->input())->links() }}
                            </div>
                        @endif
                        
                        @forelse ($bookmarks as $bookmark)
                            <div class="px-3 py-2 odd:bg-gray-100 last:border-b-0 border-b border-gray-200">
                                <div class="flex">
                                    <div class="bg-gray-800 rounded-full w-10 h-10 mr-0 mr-3 shrink-0 flex flex-col items-center justify-center self-center sm:self-start">
                                        <span class="uppercase text-gray-600 font-bold text-xl">{{ $bookmark->bookmarkable_type == 'App\Models\Blog' ? 'B' : 'P' }}</span>
                                    </div>
                                    <div class="flex sm:text-left grow justify-between items-center">
                                        <div class="flex items-center">
                                            @if ($bookmark->bookmarkable_type == 'App\Models\Blog')
                                                <h2 class="text-lg font-bold">
                                                    <a href="{{ route('blogs.show', $bookmark->bookmarkable_id) }}">{{ $bookmark->bookmarkable->name }}</a>
                                                </h2>
                                            @elseif ($bookmark->bookmarkable_type == 'App\Models\Post')
                                                <h2 class="text-lg font-bold">
                                                    <a href="{{ route('posts.show', $bookmark->bookmarkable_id) }}">{{ $bookmark->bookmarkable->title }}</a>
                                                </h2>
                                            @endif
                                            @if ($bookmark->has_changes)
                                                <span class="bg-rose-500 rounded-sm font-semibold px-1 uppercase text-xs text-white pointer-events-none select-none ml-3">
                                                    Updated
                                                </span>
                                            @endif
                                        </div>
                                        <form method="POST" action="{{ route('bookmarks.destroy', $bookmark) }}">
                                            @method('DELETE')
                                            @csrf
                                            
                                            {{-- <input type="hidden" name="friend_id" value="{{ $friend->id }}" /> --}}
                                            <x-button :type="'transparent'">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l1.664 1.664M21 21l-1.5-1.5m-5.485-1.242L12 17.25 4.5 21V8.742m.164-4.078a2.15 2.15 0 011.743-1.342 48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185V19.5M4.664 4.664L19.5 19.5" />
                                                  </svg>                                                                                             
                                            </x-button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No bookmarks were found</p>
                        @endforelse

                        @if ($bookmarks->hasPages())
                            <div class="py-6 px-6 sm:px-0">
                                {{ $bookmarks->appends(request()->input())->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
