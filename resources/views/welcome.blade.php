<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MuskAI</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <link rel="stylesheet" href="/assets/css/style.css" />
</head>
<body>
    <header>
        <h1>MuskAI 🤖</h1>
    </header>

    <main>
        <h2>Gerador de receitas</h2>
        <p>Encontre receitas deliciosas baseadas em seus ingredientes da geladeira - Inteligência Artificial transformando suas comidas em obra de arte!</p>
        <article>
            <label>Ingredientes</label>
            <form method="POST" action="{{ route('ingredientesAcao') }}">
                @csrf
                <input type="text" name="ingredientes" />
                <input type="submit" value="Enviar" value="{{ $ingredientes ?? '' }}" />
            </form>
        </article>

        @if (!empty($receita))
            {!! preg_replace("/\r\n|\n/", '<br>', $receita) !!}
        @endif
    </main>

    <footer>
        B7Web - 2023
    </footer>
</body>
</html>
