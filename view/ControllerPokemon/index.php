{% extends 'view/Layout/header.php' %}

    <h1>{{ $pokemon }}</h1>

    <span>Numéro : {{ $pokemon->getId() }}</span>

    <p>Une description</p>

    <a href="/pokedex/">Retour à la liste</a>

    <br>
    <br>
{% extends 'view/Layout/footer.php' %}
