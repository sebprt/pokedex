<?php


class Template
{
    public function __construct(){}

    public function render($file, array $data = []){
        $path = "view/".$file;

        if (file_exists($path)){
            extract($data);

            $contents = $this->includeFiles($path);
            $contents = $this->compileCode($contents);
            $contents = eval(' ?>'.$contents);

            return $contents;
        } else {
            return "Erreur de chargement du fichier modèle ($path).";
        }
    }

    protected function compileCode($code) {
        $code = $this->compilePHP($code);
        $code = $this->compileEchos($code);

        return $code;
    }

    protected function compilePHP($code) {
        return preg_replace('~\{%\s*(.+?)\s*\%}~is', '<?php $1 ?>', $code);
    }

    protected function compileEchos($code) {
        return preg_replace('~\{{\s*(.+?)\s*\}}~is', '<?php echo $1 ?>', $code);
    }

    protected function includeFiles($file) {
        $code = file_get_contents($file);
        preg_match_all('/{% ?(extends|include) ?\'?(.*?)\'? ?%}/i', $code, $matches, PREG_SET_ORDER);
        foreach ($matches as $value) {
            $code = str_replace($value[0], self::includeFiles($value[2]), $code);
        }
        $code = preg_replace('/{% ?(extends|include) ?\'?(.*?)\'? ?%}/i', '', $code);
        return $code;
    }
}
