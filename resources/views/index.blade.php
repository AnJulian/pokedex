<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        #pokemon-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        #pokemon-list li {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 150px;
            text-align: center;
            padding: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        #pokemon-list li:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        #pokemon-list a {
            text-decoration: none;
            color: #333;
            font-size: 16px;
        }

        #pokemon-details {
         
            padding: 20px;
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            max-width: 800px; 
            margin: 0 auto;
        }

        #pokemon-details img {
            max-width: 100px;
            height: auto;
            margin-bottom: 10px;
        }

        #pokemon-details h2 {
            margin-top: 0;
            color: #555;
        }

        #pokemon-details p {
            font-size: 16px;
            color: #666;
        }

        .pokemon-dropdown {
            margin: 20px;
        }

        .pokemon-details-list {
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        #pokemon-ale {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        #pokemon-ale li {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 150px;
            text-align: center;
            padding: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        #pokemon-ale li:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        #pokemon-ale a {
            text-decoration: none;
            color: #333;
            font-size: 16px;
        }
        .pokemon-aleatorio {
            
            padding: 10px;
            font-size: 16px;
            justify-content: center;
        }

    </style>
</head>
<body>
    <div>
        <h1>Selecciona un pokemon de la Pokédex con los botonesgit remote add origin https://gitlab.com/pokedex2513430/pokedexv1.git
</h1>
        <ul id="pokemon-list">
            @foreach($pokemons as $pokemon)
                <li>
                    <a href="#" class="pokemon-link" data-id="{{ $loop->index + 1 }}">
                        {{ ucfirst($pokemon['name']) }}
                    </a>
                </li>
            @endforeach
        </ul>
        <div id="pokemon-aleatorio">
        <h1>Tambien puedes seleccionar un Pokémon de la lista desplegable</h1>
        <ul id="pokemon-ale">

        <div class="container">
            <select id="pokemon-dropdown">
                 <option value="">Selecciona un Pokémon</option>
            @foreach ($pokemons as $pokemon)
            <option value="{{ $loop->index + 1 }}">{{ ucfirst($pokemon['name']) }}</option>
            @endforeach
            </select>
            <div id="result"></div>
            <div id="pokemon-details"></div>
                </div>

    <script>
        $(document).ready(function(){
            $('.pokemon-link').on('click', function(e){
                e.preventDefault();
                var id = $(this).data('id');
                $.ajax({
                    url: '{{ route('pokemon.show', '') }}/' + id,
                    method: 'GET',
                    success: function(data) {
                        var detailsHtml = '<h2>Detalles:</h2>';
                        detailsHtml += '<img src="' + data.image + '" alt="Image of Pokémon">';
                        detailsHtml += '<p>' + data.description + '</p>';
                        $('#pokemon-details').html(detailsHtml);
                    }
                });
            });
        });
    </script>

<script>
        $(document).ready(function(){
            $('#pokemon-dropdown').on('change', function(){
                var id = $(this).val(); 
                if (id) {
                    $.ajax({
                        url: '{{ route('pokemon.show', '') }}/' + id,
                        method: 'GET',
                        success: function(data) {
                            var detailsHtml = '<h2>Detalles:</h2>';
                            detailsHtml += '<img src="' + data.image + '" alt="Image of Pokémon">';
                            detailsHtml += '<p>' + data.description + '</p>';
                            $('#pokemon-details').html(detailsHtml);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error en la solicitud:', status, error);
                            $('#pokemon-details').html('<p>Ocurrió un error al obtener los detalles del Pokémon.</p>');
                        }
                    });
                } else {
                    $('#pokemon-details').html('<p>Selecciona un Pokémon</p>');
                }
            });
        });
    </script>
     

    


        


    
</body>
</html>
