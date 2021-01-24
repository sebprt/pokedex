<?php

require('core/AbstractController.php');
require('core/Request.php');
require('model/Pokemon.php');
require('core/Template.php');

class ControllerPokemon extends AbstractController
{

    /**
     * Homepage action controller
     *
     * @throws Exception
     */
    public function index()
    {
        $request = new Request();

        $pokemon = $this->getDoctrine()->findOneById($request->get('id'));


        $this->render('ControllerPokemon/index.php', [
            'pokemon' => $pokemon
        ]);
    }
}
