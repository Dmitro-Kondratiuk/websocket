@extends('layout.layout')

@section('content')
    <h1>Ваші чати</h1>

    <ul>
        @foreach($chats as $chat)
            <li>
                <a href="{{ route('chat.show', $chat->id) }}">
                    Чат з {{ $chat->users->pluck('name')->join(', ') }}
                </a>
            </li>
        @endforeach
    </ul>

    <form action="{{ route('chat.store') }}" method="POST">
        @csrf
        <label for="user_id">Створити чат з користувачем (ID):</label>
        <input type="number" name="user_id" id="user_id" required>
        <button type="submit">Створити чат</button>
    </form>
@endsection
