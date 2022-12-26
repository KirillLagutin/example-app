@extends('layout')

@section('title')
    Отзывы
@endsection

@section('main_content')

    <h1>Добавитиь отзывы</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="/review/check">
        @csrf
        <input type="email" name="email" id="email" placeholder="Введите email" class="form-control"/>
        <br>
        <input type="text" name="subject" id="subject" placeholder="Введите отзыв" class="form-control"/>
        <br>
        <textarea name="message" id="message" placeholder="Введите сообщение" class="form-control"></textarea>
        <br>
        <button type="submit" class="btn btn-success">Отправить</button>
    </form><br>

    <h1>Все отзывы</h1>
    @foreach($reviews as $item)
        <div class="alert alert-warning">
            <h3>{{ $item->subject }}</h3>
            <b>{{ $item->email }}</b>
            <p>{{ $item->message }}</p>
        </div>
    @endforeach

@endsection