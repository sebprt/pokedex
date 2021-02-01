<?php


class Template
{
    public function __construct(){}

    public function render($file, array $data = []){
        $path = "view/".$file;

        if (file_exists($path)){
            extract($data);

            $contents = $this->include($path);
            $contents = $this->compile($contents);
            $contents = eval(' ?>'.$contents);

            return $contents;
        } else {
            return "Erreur de chargement du fichier modèle ($path).";
        }
    }

    protected function compile($code) {
        $code = $this->compileInstructions($code);
        $code = $this->compileText($code);

        return $code;
    }

    protected function compileInstructions($code) {
        return preg_replace('~\{%\s*(.+?)\s*\%}~is', '<?php $1 ?>', $code);
    }

    protected function compileText($code) {
        return preg_replace('~\{{\s*(.+?)\s*\}}~is', '<?php echo $1 ?>', $code);
    }

    protected function include($file) {
        $code = file_get_contents($file);
        preg_match_all('/{% ?(extends|include) ?\'?(.*?)\'? ?%}/i', $code, $matches, PREG_SET_ORDER);
        foreach ($matches as $value) {
            $code = str_replace($value[0], self::include($value[2]), $code);
        }
        $code = preg_replace('/{% ?(extends|include) ?\'?(.*?)\'? ?%}/i', '', $code);
        return $code;
    }
}
