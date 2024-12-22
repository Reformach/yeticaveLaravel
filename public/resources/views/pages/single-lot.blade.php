@extends('layout')

@section('title', 'Страница лота')

@section('page-content')
    <x-nav></x-nav>
    <section class="lot-item container">
        <h2>{{$lot->title}}</h2>
        <div class="lot-item__content">
            <div class="lot-item__left">
                <div class="lot-item__image">
                    <img src="/{{$lot->url}}" width="730" height="548" alt="Сноуборд">
                </div>
                <p class="lot-item__category">Категория: <span>{{$lot->category->title}}</span></p>
                <p class="lot-item__description">{{$lot->description}}</p>
            </div>
            <div class="lot-item__right">
                <div class="lot-item__state">
                    <div class="lot-item__timer timer">
                        10:54
                    </div>
                    <div class="lot-item__cost-state">
                        <div class="lot-item__rate">
                            <span class="lot-item__amount">Текущая цена</span>
                                <span class="lot-item__cost">@if($bets->count()>0) {{$lastBet->bet_price}} @else {{$lot->price}} @endif</span>
                        </div>
                        <div class="lot-item__min-cost">
                                Мин. ставка <span>@if($bets->count()>0) {{$lastBet->bet_price + $lot->bet_step}} @else {{$lot->price + $lot->bet_step}} @endif</span>
                        </div>
                    </div>
                    <form class="lot-item__form" action="{{ route('lot-place-bet', $lot->id) }}" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        <p class="lot-item__form-item form__item @if($errors->any()) {{ 'form__item--invalid' }} @endif">
                            <label for="cost">Ваша ставка</label>
                                <input id="cost" name="bet_price" placeholder="@if($bets->count()>0){{ $lastBet->bet_price + $lot->bet_step }}@else{{ $lot->price + $lot->bet_step }}@endif руб." value="{{ old('bet_price') }}">
                            @error('bet_price')
                                <span class="form__error">Введите корректную сумму</span>
                            @enderror
                        </p>
                        @if (Auth::user())
                            <button type="submit" class="button @error('bet_price'){{ 'lot-item__min-cost' }}@enderror">Сделать ставку</button>
                        @else
                            <a href="{{route('signup-page')}}" type="submit" class="button">Авторизируйтесь</a>
                        @endif
                    </form>
                </div>
                <div class="history">
                    @if($bets->count()>0)
                        <h3>История ставок (<span>{{$bets->count()}}</span>)</h3>
                    @else
                        <p>На данный момент ставок нет.</p>
                    @endif
                    <table class="history__list">
                        @foreach($bets->sortByDesc('bet_date') as $bet)
                            <x-bet :bet="$bet"></x-bet>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
