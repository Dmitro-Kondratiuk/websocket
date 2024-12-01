@extends('layout.layout')

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Чат</h4>
            </div>
            <div class="card-body">
                <ul id="messages" class="list-unstyled overflow-auto" style="max-height: 400px;">
                    @foreach($messages as $message)
                        <li class="mb-3" id="message-{{ $message->id }}">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <strong>{{ $message->user->name }}</strong>:
                                </div>
                                <div class="message-content bg-light p-2 rounded">
                                    {{ $message->message }}
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="card-footer">
                <form id="message-form">
                    <div class="input-group">
                        <textarea class="form-control" name="message" id="message-input" placeholder="Введіть повідомлення..." required></textarea>
                        <button class="btn btn-primary" type="submit">Відправити</button>
                    </div>
                    <input type="hidden" name="chat-id" id="chat-id" value="{{$chat->id}}">
                </form>
            </div>
        </div>
    </div>
@endsection
