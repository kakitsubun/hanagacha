@extends('base')
@section('content')
    <div class="container">
        <h1>{{ $message }}</h1>
        <div class="panel">
            <h3>Add Gacha Item</h3>
            <form action="{{ URL('gacha/store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                Name: <input type="text" name="name" class="form-notfull" required="required"><br/>
                Weight: <input type="text" name="weight" class="form-notfull" required="required"><br/>
                Rarity: 
                <input type="radio" name="rarity" value="1" checked="checked">Common
                <input type="radio" name="rarity" value="2">Uncommon
                <input type="radio" name="rarity" value="3">Rare
                <input type="radio" name="rarity" value="4">Super Rare
                <br />
                <button class="btn btn-lg btn-info">ADD</button>
            </form>
            <br/>
            <ul class="list-group">
                @foreach ($gachas as $gacha)
                    <li class="list-group-item">{{ $gacha->name }}({{ $gacha->weight}})
                        <form action="{{ URL('gacha/delete') }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="gacha_id" value="{{ $gacha->id }}">
                            <button style="float:right">DELETE</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
