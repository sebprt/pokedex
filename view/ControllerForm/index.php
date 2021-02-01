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
                    {% foreach($types as $item => $type): %}
                        {% if(in_array($type->getLabel(), $arrayTypes)): %}
                            <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="types[]" value="{{ $type->getId() }}" id="CheckChecked{{ $item }}" checked>
                                <label class="form-check-label" for="CheckChecked{{ $item }}">
                                    {{ $type->getLabel() }}
                                </label>
                            </div>
                        {% else: %}
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="types[]" value="{{ $type->getId() }}" id="CheckChecked{{ $item }}">
                                <label class="form-check-label" for="CheckChecked{{ $item }}">
                                    {{ $type->getLabel() }}
                                </label>
                            </div>
                        {% endif; %}
                    {% endforeach; %}
                {% else: %}
                    {% foreach($types as $item => $type): %}
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="types[]" value="{{ $type->getId() }}" id="flexCheck{{ $item }}">
                            <label class="form-check-label" for="flexCheck{{ $item }}">
                                {{ $type->getLabel() }}
                            </label>
                        </div>
                    {% endforeach; %}
                {% endif; %}

        </div>
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
{% extends 'view/Layout/footer.php' %}
