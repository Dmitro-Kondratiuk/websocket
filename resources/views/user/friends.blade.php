@extends('layout.layout')

@section('title', 'Мої Друзі')

@section('content')
    <div class="friends-page">
        <h1>Мої Друзі</h1>

        @if($friends->toCollection()->isEmpty())
            <p>У вас поки що немає друзів. Запросіть їх!</p>
        @else
            <div class="friends-list">
                @foreach($friends as $friend)
                    <div class="friend-item" style="margin-bottom: 10px">
                        <img src="{{ $friend->profile_picture ?? 'https://via.placeholder.com/100' }}"
                             alt="{{ $friend->name }}"
                             class="friend-avatar">
                        <div class="friend-info">
                            <h3>{{ $friend->name }}</h3>
                            <p>{{ $friend->email }}</p>
                        </div>
                        <a href="" class="btn btn-primary">
                            Розпочати чат
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Секція "Потенційні друзі" --}}
        <h2 class="potential-friends-title align-content-center">Потенційні друзі</h2>

        @if($potentialFriends->toCollection()->isEmpty())
            <p>Немає потенційних друзів.</p>
        @else
            <div class="friends-list">
                @foreach($potentialFriends as $potentialFriend)
                    <div class="friend-item">
                        <img src="{{ $potentialFriend->profile_picture ?? 'https://via.placeholder.com/100' }}"
                             alt="{{ $potentialFriend->name }}"
                             class="friend-avatar">
                        <div class="friend-info">
                            <h3>{{ $potentialFriend->name }}</h3>
                            <p>{{ $potentialFriend->email }}</p>
                        </div>
                        <form action="{{ route('friend.add', $potentialFriend->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Додати в друзі</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
