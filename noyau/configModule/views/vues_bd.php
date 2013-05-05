{% extends "noyau/configModule/views/default.html.twig" %}

{% block intro %}
    Configuration base de données
{% endblock %}

{% block content %}
    <p class="erreur">{{ erreur }}</p>
    <div class="form">
        {{ form|raw }}
    </div>
{% endblock %}