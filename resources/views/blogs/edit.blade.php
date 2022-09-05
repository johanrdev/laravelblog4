@extends('dashboard')

@section('content')
    @if ($errors->any())
            @foreach ($errors->all() as $error)
                <x-alert :message="$error"></x-alert>
            @endforeach
        </ul>
    @endif
    
    <form method="POST" action="{{ route('blogs.destroy', $blog) }}">
        @method('DELETE')
        @csrf

        <div class="flex justify-end">
            <input type="submit" class="py-2 px-4 rounded bg-transparent text-rose-500 underline font-bold text-white cursor-pointer" value="Delete" />
        </div>
    </form>

    <form method="POST" action="{{ route('blogs.update', $blog) }}">
        @method('PUT')
        @csrf

        <div class="flex flex-col mb-3">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $blog->name }}" required />
        </div>

        <div class="flex flex-col mb-3">
            <label for="description">Content:</label>
            <textarea name="description" id="description" cols="30" rows="10" required>{{ $blog->description }}</textarea>
        </div>

        <div class="flex justify-end">
            <x-button type="green">Update</x-button>
        </div>
    </form>
@endsection