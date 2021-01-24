{% extends 'view/Layout/header.php' %}
    <h1 class="pb-3">{{ $title }}</h1>
    <form id="form" method="post">
        <div>
            <label for="nom" class="pb-2">Nom</label>
            <input type="text" class="form-control" id="name" name="name" value="{% if(!is_null($pokemon)): %}{{ $pokemon->getName() }}{% endif; %}"
                   aria-describedby="emailHelp" placeholder="Entrer un nom de pokemon">

        </div>
        <div class="py-3">
            <label for="types" class="pb-2">Types</label>
                {% if(!is_null($arrayTypes)): %}
                    {% foreach($arrayTypes as $pokemonType): %}
                        {% $pokemonType %}
                    {% endforeach; %}

                    {% foreach($types as $type): %}
                        {% if($type->getLabel()===$pokemonType): %}
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="types[]" value="{{ $type->getId() }}" id="flexCheckChecked" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                    {{ $type->getLabel() }}
                                </label>
                            </div>
                        {% else: %}
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="types[]" value="{{ $type->getId() }}" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    {{ $type->getLabel() }}
                                </label>
                            </div>
                        {% endif; %}
                    {% endforeach; %}
                {% else: %}
                    {% foreach($types as $type): %}
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="types[]" value="{{ $type->getId() }}" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                {{ $type->getLabel() }}
                            </label>
                        </div>
                    {% endforeach; %}
                {% endif; %}

        </div>
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
{% extends 'view/Layout/footer.php' %}
