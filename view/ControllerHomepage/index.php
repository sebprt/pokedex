{% extends 'view/Layout/header.php' %}

<h1>Pokédex</h1>

<table class="table mt-4">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nom</th>
        <th scope="col">Types</th>
        <th scope="col">Options</th>
    </tr>
    </thead>
    <tbody>
    {% foreach($pokemons as $pokemon): %}
    <tr>
        <td>
            {{ $pokemon->getId() }}
        </td>
        <td>
            <a href="/pokemon/{{ $pokemon->getId() }}">
                {{ $pokemon }}
            </a>
        </td>
        <td>
            {{ $pokemon->getTypes() }}
        </td>
        <td>
            <a href="/form/{{ $pokemon->getId() }}">
                Editer
            </a>
        </td>
    </tr>
    {% endforeach; %}
    </tbody>
</table>


{% extends 'view/Layout/footer.php' %}
