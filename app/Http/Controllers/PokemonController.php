<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokemonController extends Controller
{
     
    public function index()
    {
        $response = Http::get('https://pokeapi.co/api/v2/pokemon?limit=10');
        $pokemons = $response->json()['results'];

        return view('index', compact('pokemons'));
    }

    public function show($id)
    {
        $pokemonResponse = Http::get("https://pokeapi.co/api/v2/pokemon/{$id}");
        $pokemonDetails = $pokemonResponse->json();

        $speciesResponse = Http::get("https://pokeapi.co/api/v2/pokemon-species/{$id}");
        $speciesDetails = $speciesResponse->json();

        $spanishDescription = collect($speciesDetails['flavor_text_entries'])->firstWhere('language.name', 'es')['flavor_text'];
        $imageUrl = $pokemonDetails['sprites']['front_default'];

        return response()->json([
            'description' => $spanishDescription ?: 'Descripción no disponible en español',
            'image' => $imageUrl
        ]);
    }
   
  /* 
 public function random()
    {
        $response = Http::get('https://pokeapi.co/api/v2/pokemon?limit=1000');
        $allPokemons = $response->json()['results'];
        $randomPokemons = collect($allPokemons)->random(10);

        return response()->json($randomPokemons);
    }
*/




   


}
