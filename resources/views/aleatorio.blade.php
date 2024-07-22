<!DOCTYPE html>
<html>
<head>
    <title>Pokémon List</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h1>Pokémon List</h1>
    <ul id="pokemon-list">
        @foreach($pokemons as $pokemon)
            <li data-url="{{ $pokemon['url'] }}">{{ $pokemon['name'] }}</li>
        @endforeach
    </ul>

    <h2>Random Pokémon</h2>
    <select id="random-pokemon">
        <!-- Options will be populated by AJAX -->
    </select>

    <div id="pokemon-details">
        <h2>Pokémon Details</h2>
        <div id="details"></div>
    </div>

    <script>
        $(document).ready(function() {
            // Load random Pokémon options
            $.ajax({
                url: '{{ route('pokemon.random') }}',
                method: 'GET',
                success: function(data) {
                    data.forEach(function(pokemon) {
                        $('#random-pokemon').append('<option value="' + pokemon.url + '">' + pokemon.name + '</option>');
                    });
                }
            });

            // Show details when clicking a Pokémon from the list
            $('#pokemon-list').on('click', 'li', function() {
                var url = $(this).data('url');
                showPokemonDetails(url);
            });

            // Show details when selecting a Pokémon from the dropdown
            $('#random-pokemon').change(function() {
                var url = $(this).val();
                showPokemonDetails(url);
            });

            function showPokemonDetails(url) {
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(details) {
                        $('#details').html(
                            '<h3>' + details.name + '</h3>' +
                            '<img src="' + details.sprites.front_default + '" alt="' + details.name + '">' +
                            '<p>Height: ' + details.height + '</p>' +
                            '<p>Weight: ' + details.weight + '</p>'
                        );
                    }
                });
            }
        });
    </script>
</body>
</html>