<?php

require('core/AbstractController.php');
require('core/Request.php');
require('model/Pokemon.php');
require('core/Template.php');

class ControllerHomepage extends AbstractController {

    /**
     * Homepage action controller
     *
     * @throws Exception
     */
    public function index() {
        $pokemons = $this->getDoctrine()->findAll();

        $this->render('ControllerHomepage/index.php', [
            'pokemons' => $pokemons
        ]);
    }
}
