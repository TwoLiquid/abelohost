@extends('dashboard.layouts.default')

@section('breadcrumbs')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">Описание API</h1>
    </div>

@stop

@section('content')

    <h5>1. Авторизация</h5> <br>

    <p>Для получения <code>токена авторизации</code> необходимо использовать следующий роут:</p>
    <pre><code class="language-html">POST http://DOMAIN/api/auth/login
</code></pre> <br>

    <p>Данные для авторизации передаем в теле <code>POST</code> запроса в формате <code>JSON</code>:</p>
    <pre><code class="language-javascript">{
    "email": "api-test@abelohost.com",
    "password": "qwerty"
}</code></pre> <br>

    <p>Успешный ответ будет выглядить следующим образом:</p>
    <pre><code class="language-javascript">{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMGJmNGE0OWI4OTQ2MGMwMTQwOWUzMzdmNTc0YWIzNmJhYjEwZjgyMzc2YzEwNmZmMGNkODg5ZDViNzQ0N2UxNTMyNTg3M2E2OWZhZjZhMTMiLCJpYXQiOjE2MDcyOTc5MDUsIm5iZiI6MTYwNzI5NzkwNSwiZXhwIjoxNjM4ODMzOTA1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.TzckBtBOllHe3Ja8dfc1qb2ByNJ_iiCE9qC7PU3N_As9S8e3CWo7Qp-TjJ1RozodB2v2QHqCuSO34IBm7SUS6HG6kKdfjKQnHD3bfmB0VO8qkvDzDTVn46i-hikJupuj_7wkwL-DD0-7GObFTOFhiZbdpX9KoZTTNNMb_oPt9tdowDmDf76J_LdNOhaKll26cT_G4vgQc_dp4yppQD_cBoo4lXNeznCuJNLPeBJiWvy4zki4yofYVpjTo9YZN4aDlnbNWy5OZKuLFYTFcNnqAT2TP6SwL8F-vIrJSoWcNuYhv-WiCwZTKxWAFpkpLTz1XmjLDkGVblv3VAztrFl7NrKNOGh0TdyQW1V9LlFs9BcuUeWfN0Fn-fr_aSlbOQH8jvqNrvugRLUyJjR4g-svflEOH_n2rRFjmDViwYy1N-256ONASKH0TXi5MNQqZUxkvQGZEvCMdzmkodsUTax9jVkQe5gu81NmmFtxZ6BIYxOm6Lz3L1j4GboCJf8tkZNrKmHgiPbJZrPJiTxDoKRihleUZjnqBc939PolLqLus1tT9RZs0lpnURM6FP7xvJh9zsMEvb_RgGTyplgJq2AlpehHjCthG0w1EDhBn2TJFpomOP6w9dHUdg8CcBtLKDTgl5hGwz2H2ImeHyg8e8JR_hCkVw3pjLQ5mbieUIShfLQ",
    "message": "Вы успешно вошли в систему."
}</code></pre> <br>

    <p>В случае неверных данных авторизации ответ будет таким:</p>
    <pre><code class="language-javascript">{
    "error": {
        "message": "Не удалось авторизовать пользователя."
    }
}</code></pre> <br>

    <h5>2. Получение списка товаров</h5> <br>

    <p>Для обращения к <code>методам API</code> необходимо добавить заголовок:</p>
    <pre><code class="language-javascript">{
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMGJmNGE0OWI4OTQ2MGMwMTQwOWUzMzdmNTc0YWIzNmJhYjEwZjgyMzc2YzEwNmZmMGNkODg5ZDViNzQ0N2UxNTMyNTg3M2E2OWZhZjZhMTMiLCJpYXQiOjE2MDcyOTc5MDUsIm5iZiI6MTYwNzI5NzkwNSwiZXhwIjoxNjM4ODMzOTA1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.TzckBtBOllHe3Ja8dfc1qb2ByNJ_iiCE9qC7PU3N_As9S8e3CWo7Qp-TjJ1RozodB2v2QHqCuSO34IBm7SUS6HG6kKdfjKQnHD3bfmB0VO8qkvDzDTVn46i-hikJupuj_7wkwL-DD0-7GObFTOFhiZbdpX9KoZTTNNMb_oPt9tdowDmDf76J_LdNOhaKll26cT_G4vgQc_dp4yppQD_cBoo4lXNeznCuJNLPeBJiWvy4zki4yofYVpjTo9YZN4aDlnbNWy5OZKuLFYTFcNnqAT2TP6SwL8F-vIrJSoWcNuYhv-WiCwZTKxWAFpkpLTz1XmjLDkGVblv3VAztrFl7NrKNOGh0TdyQW1V9LlFs9BcuUeWfN0Fn-fr_aSlbOQH8jvqNrvugRLUyJjR4g-svflEOH_n2rRFjmDViwYy1N-256ONASKH0TXi5MNQqZUxkvQGZEvCMdzmkodsUTax9jVkQe5gu81NmmFtxZ6BIYxOm6Lz3L1j4GboCJf8tkZNrKmHgiPbJZrPJiTxDoKRihleUZjnqBc939PolLqLus1tT9RZs0lpnURM6FP7xvJh9zsMEvb_RgGTyplgJq2AlpehHjCthG0w1EDhBn2TJFpomOP6w9dHUdg8CcBtLKDTgl5hGwz2H2ImeHyg8e8JR_hCkVw3pjLQ5mbieUIShfLQ"
}
</code></pre> <br>

    <p>Для получения <code>списка товаров</code> необходимо использовать следующий роут:</p>
    <pre><code class="language-html">GET http://DOMAIN/api/items/get
</code></pre> <br>

    <p>Успешный ответ будет выглядить следующим образом:</p>
    <pre><code class="language-javascript">[
    {
        "id": 1,
        "name": "Товар номер 1",
        "description": "Описание первого товара",
        "price": 1000
    },
    {
        "id": 5,
        "name": "Товар номер 2",
        "description": null,
        "price": 1800
    }
]</code></pre> <br>

    <h5>3. Получение одного товара</h5> <br>

    <p>Для получения <code>товара по его ID </code> необходимо использовать следующий роут:</p>
    <pre><code class="language-html">GET http://DOMAIN/api/items/{id}
</code></pre> <br>

    <p>Успешный ответ будет выглядить следующим образом:</p>
    <pre><code class="language-javascript">{
        "id": 1,
        "name": "Товар номер 1",
        "description": "Описание первого товара",
        "price": 1000
}</code></pre> <br>

    <p>Неуспешный ответ будет выглядить следующим образом:</p>
    <pre><code class="language-javascript">{
    "error": {
        "message": "Товар не найден."
    }
}</code></pre> <br>

    <h5>4. Добавление нового товара</h5> <br>

    <p>Для добавления <code>нового товара</code> необходимо использовать следующий роут:</p>
    <pre><code class="language-html">POST http://DOMAIN/api/items/create
</code></pre> <br>

    <p>Данные для добавления передаем в теле запроса в формате <code>JSON</code>:</p>
    <pre><code class="language-javascript">{
    "name": "Товар номер 3",
    "description": "Описание (необязательно)",
    "price": 5400
}</code></pre> <br>

    <p>Успешный ответ будет выглядить следующим образом:</p>
    <pre><code class="language-javascript">{
    "message": "Новый товар успешно добавлен."
}</code></pre> <br>

    <p>Неуспешный ответ будет выглядить следующим образом:</p>
    <pre><code class="language-javascript">{
    "error": {
        "message": "Не удалось добавить новый товар."
    }
}</code></pre> <br>

    <h5>5. Изменение товара</h5> <br>

    <p>Для изменения данных <code>уже добавленного товара</code> необходимо использовать следующий роут:</p>
    <pre><code class="language-html">PATCH http://DOMAIN/api/items/{id}/update
</code></pre> <br>

    <p>Данные для добавления передаем в теле запроса в формате <code>JSON</code>:</p>
    <pre><code class="language-javascript">{
    "name": "Товар номер 4",
    "description": "Описание (необязательно)",
    "price": 7200
}</code></pre> <br>

    <p>Успешный ответ будет выглядить следующим образом:</p>
    <pre><code class="language-javascript">{
    "message": "Данные товара успешно обновлены."
}</code></pre> <br>

    <p>Неуспешный ответ будет выглядить следующим образом:</p>
    <pre><code class="language-javascript">{
    "error": {
        "message": "Не удалось обновить данные товара."
    }
}</code></pre> <br>

    <h5>6. Удаление товара</h5> <br>

    <p>Для удаления <code>уже добавленного товара</code> необходимо использовать следующий роут:</p>
    <pre><code class="language-html">DELETE http://DOMAIN/api/items/{id}/delete
</code></pre> <br>

    <p>Успешный ответ будет выглядить следующим образом:</p>
    <pre><code class="language-javascript">{
    "message": "Товар успешно удален."
}</code></pre> <br>

    <p>Неуспешный ответ будет выглядить следующим образом:</p>
    <pre><code class="language-javascript">{
    "error": {
        "message": "Не удалось удалить товара."
    }
}</code></pre> <br>

@stop
