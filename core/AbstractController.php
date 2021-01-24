<?php

abstract class AbstractController {

    protected $request;

    abstract public function index();

    /**
     * Create view with data
     *
     * @param array $data
     *
     * @throws Exception
     */
    protected function render(string $file, array $data = [])
    {
        try {
            $view = new Template();
            $this->getDoctrine();
        }
        catch(Exception $e) {
            throw new Exception('No view');
        }

        return $view->render($file, $data);
    }

    protected function getDoctrine()
    {
        $class = Pokemon::class;

        /*$class = get_class($this);
        if (strstr($class, 'Controller')){
            $class = str_replace('Controller', '', $class);
        }*/

        return new $class;
    }

    /**
     * Setter for request object
     *
     * @param $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }
}
