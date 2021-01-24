<?php

require('core/AbstractController.php');
require('core/Request.php');
require('model/Pokemon.php');
require('model/Type.php');
require('core/Template.php');

class ControllerForm extends AbstractController
{
    /**
     * Homepage action controller
     *
     * @throws Exception
     */
    public function index()
    {
        $request = new Request();
        $types = (new Type())->findAll();

        if ($request->get('id')) {
            $id = array('id' => $request->get('id'));
            $pokemon = $this->getDoctrine()->findOneById($request->get('id'));
            $data = $id + $request->getRequest();

            if (!empty($data)) {
                $this->getDoctrine()->save($data);
            }

            $title = 'Editer '.$pokemon->getName();
            $arrayTypes = explode(",", $pokemon->getTypes());
        } else {
            $pokemon=null;
            $data = $request->getRequest();

            if (!empty($data)) {
                $this->getDoctrine()->save($data);
            }

            $title = 'Ajouter un pokemon';
            $arrayTypes = null;
        }

        $this->render('ControllerForm/index.php', [
            'pokemon' => $pokemon,
            'types' => $types,
            'title' => $title,
            'arrayTypes' => $arrayTypes
        ]);
    }
}
