@extends('layouts.cabinet')

@section('content')
    <section class="partnership uk-margin-large-top uk-background-muted">
        <div class="uk-container uk-padding">
            <h1 class="uk-text-center">
                Партнёрская программа
            </h1>
            <div class="uk-flex uk-flex-center" uk-grid>
                <div class="uk-width-2-3@s  uk-card uk-card-default uk-card-body">
                    <p class="uk-text-bold uk-text-center">Ваш промо-код:</p>
                    <p class="uk-text-bold uk-text-red uk-text-center">kosmos89</p>
                    <table class="uk-table uk-table-hover uk-table-divider">
                        <thead>
                        <tr>
                            <th class="uk-width-auto">№</th>
                            <th>Имя</th>
                            <th>Дата</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Вася Пупкин</td>
                            <td class="uk-text-bold">01.11.2018</td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Иванов Иван</td>
                            <td class="uk-text-bold">05.11.2018</td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Вася Пупкин</td>
                            <td class="uk-text-bold">10.11.2018</td>
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td>Иванов Иван</td>
                            <td class="uk-text-bold">23.11.2018</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
