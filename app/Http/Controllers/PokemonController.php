<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

use App\Pokemon;
use App\User;
use App\Notifications\PokemonLimit;

class PokemonController extends Controller
{

	use Notifiable;
    //Controller para resolução do exercicio.
    //Completem as funções com as notificações necessárias.
	public function pokemonCapturado(Request $request, $user_id){
		//Pega o usuário com o id passado
		
		$user = User::find($user_id);

		//novo Pokemon é atribuído ao Usuario
		$novoPokemon = new Pokemon;
		$novoPokemon->nome = $request->nome;
		$novoPokemon->tipo_1 = $request->tipo_1;
		$novoPokemon->genero = $request->genero;
		$novoPokemon->user_id = $user_id;
		$novoPokemon->save();
		//qtdPokedex recebe +1
		$user->qtdPokedex = $user->qtdPokedex+1;
		$user->save();


		//Caso a qtdPokedex seja maior/igual a 70 e menor que 100...
		if($user->qtdPokedex >= 70 && $user->qtdPokedex <100){
			//usuário deve ser notificado por e-mail que a pokedex ficará cheia em breve
			//O email deve mostrar a quantidade de pokemon que estão na pokedex
			$user->notify(new PokemonLimit($user));	
		}


		//Caso a qtdPokedex seja igual a 100...
		if($user->qtdPokedex == 100){
			//mensagem de erro, pois não é possível adicionar um novo pokemon
			$mensagem = 'POKEDEX CHEIA. Retire um pokemon para continuar.';
			return $mensagem;
		}

		
		
		
		
		//e a cor branca na barra de baixo
		//Editem o corpo do email e substituam o "Regards" padrão por outras palavras, como "Att", "Abraços", etc.
		//		   [ NECESSARIO COMPLETAR ]



		//mensagem de sucesso é retornada ao usuario
		$mensagem = 'Pokemon adicionado.';
		return $mensagem;
	}
}
