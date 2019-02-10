<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pokemon;
use App\User;

class PokemonController extends Controller
{
    //Controller para resolução do exercicio.
    //Completem as funções com as notificações necessárias.
	public function pokemonCapturado(Request $request, $user_id){
		//Pega o usuário com o id passado
		$user = User::find($user_id);


		/*Caso a qtdPokedex seja maior/igual a 70 e menor que 100...
		if($user->qtdPokedex >= 70 && $user->qtdPokedex <100){
			//usuário deve ser notificado por e-mail que a pokedex ficará cheia em breve
			//O email deve mostrar a quantidade de pokemon que estão na pokedex
			//     [ NECESSARIO COMPLETAR ]
		}*/


		//Caso a qtdPokedex seja igual a 100...
		if($user->qtdPokedex == 100){
			//mensagem de erro, pois não é possível adicionar um novo pokemon
			$mensagem = 'POKEDEX CHEIA. Retire um pokemon para continuar.';
			return $mensagem;
		}
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

		//Será necessário notificar o usuário por e-mail sobre seu novo Pokemon
		//No email devem estar os dados da nova instancia do pokemon
		//O email deve ter a cor vermelha na barra de cima 
		//e a cor branca na barra de baixo
		//Editem o corpo do email e substituam o "Regards" padrão
		//		   [ NECESSARIO COMPLETAR ]



		//mensagem de sucesso é retornada ao usuario
		$mensagem = 'Pokemon adicionado.';
		return $mensagem;
	}
}
