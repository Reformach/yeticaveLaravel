@extends('layout')

@section('title', 'Добавление лота')

@section('head')
    @parent
    <link rel="stylesheet" href="/css/flatpickr.min.css">
@endsection

@section('scripts')
    <script src="/js/flatpickr.js"></script>
    <script src="/js/script.js"></script>
@endsection

@section('page-content')
    <main>
        <x-nav></x-nav>
        <form class="form form--add-lot container @if($errors->any()) form--invalid @endif"
              action="{{route('addlot')}}"
              method="post"
              enctype="multipart/form-data">
            @csrf
            <h2>Добавление лота</h2>
            <div class="form__container-two">
                <div class="form__item @error('lot-name') form__item--invalid @enderror">
                    <label for="lot-name">Наименование <sup>*</sup></label>
                    <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="{{ old('lot-name') }}">
                    @error('lot-name')
                    <span class="form__error">Введите наименование лота</span>
                    @enderror
                </div>
                <div class="form__item @error('category') form__item--invalid @enderror">
                    <label for="category">Категория <sup>*</sup></label>
                    <select id="category" name="category">
                        <option selected disabled>Выберите категорию</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if(old('category') == $category->id) selected @endif>{{ $category->title }}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <span class="form__error">Выберите категорию</span>
                    @enderror
                </div>
            </div>
            <div class="form__item form__item--wide @error('message') form__item--invalid @enderror">
                <label for="message">Описание <sup>*</sup></label>
                <textarea id="message" name="message" placeholder="Напишите описание лота">{{ old('message') }}</textarea>
                @error('message')
                <span class="form__error">Напишите описание лота</span>
                @enderror
            </div>
            <div class="form__item form__item--file @error('lot-image') form__item--invalid @enderror">
                <label>Изображение <sup>*</sup></label>
                <div class="form__input-file">
                    <input class="visually-hidden" type="file" id="lot-img" name="lot-image">
                    <label for="lot-img">Добавить</label>
                </div>
                @error('lot-image')
                <span class="form__error">Изображение обязательно для загрузки (только форматы png, jpeg)</span>
                @enderror
            </div>
            <div class="form__container-three">
                <div class="form__item form__item--small @error('lot-rate') form__item--invalid @enderror">
                    <label for="lot-rate">Начальная цена <sup>*</sup></label>
                    <input id="lot-rate" type="text" name="lot-rate" placeholder="0" value="{{ old('lot-rate') }}">
                    @error('lot-rate')
                    <span class="form__error">Введите начальную цену</span>
                    @enderror
                </div>
                <div class="form__item form__item--small @error('lot-step') form__item--invalid @enderror">
                    <label for="lot-step">Шаг ставки <sup>*</sup></label>
                    <input id="lot-step" type="text" name="lot-step" placeholder="0" value="{{ old('lot-step') }}">
                    @error('lot-step')
                    <span class="form__error">Введите шаг ставки</span>
                    @enderror
                </div>
                <div class="form__item @error('lot-date') form__item--invalid @enderror">
                    <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
                    <input class="form__input-date" id="lot-date" type="text" name="lot-date"
                           placeholder="Введите дату в формате ГГГГ-ММ-ДД" >
                    @error('lot-date')
                    <span class="form__error">Введите дату завершения торгов</span>
                    @enderror
                </div>
            </div>
            <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
            <button type="submit" class="button">Добавить лот</button>
        </form>
    </main>
@endsection


