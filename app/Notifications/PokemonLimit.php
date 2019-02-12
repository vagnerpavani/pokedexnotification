<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use DB;

class PokemonLimit extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $user = $notifiable;
        $pokemon=DB::table('pokemon')->where('user_id',$user->id)->orderBy('id','desc')->first();
        return (new MailMessage)
                    ->greeting('Olá '.$user->nome)
                    ->line('Parabens por capturar um '. $pokemon->nome .' Porem,')
                    ->line('Você ja possui '.$user->qtdPokedex .'/100') 
                    ->line('Seu número de Pokemons está muito alto, em breve sua Pokedex chegará no limite...')
                    ->line('Boa sorte!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
