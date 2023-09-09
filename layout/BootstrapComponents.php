<?php
class BootstrapComponent{

    /**
     * Permet de créer un champ input du formulaire  bootstrap
     * @param string $type Le type du champ
     * @param string $name Le nom de la variable que la logique utilisera
     * @param string $label Le label visible dans le champ.
     * @return string $heredoc La structure html formatée
     */
    public static function form_input($type, $name, $label, $min = 0, $max =10000000){
        $value = $_POST[''.$name]??'';
        $minValeur = ($type=='number')?$min:'';
        $maxValeur = ($type=='number' || $type=='date')?$max:'';
        return <<<HTML
            <div class="form-floating my-2">
                <input type="$type" class="form-control" id="floatingInput" name="$name" placeholder="$label" value="$value" min="$minValeur" max="$maxValeur" required>
                <label for="floatingInput">$label</label>
            </div>
HTML;
    }

    /**
     * Permet de créer un champ select du formulaire  bootstrap
     * @param string $name Le nom de la variable que la logique utilisera
     * @param array $options La liste des options associés
     * @param string $label Le label visible dans le champ.
     * @return string $heredoc La structure html formatée
     */
    public static function form_select($name, array $options, $label){
        $selected = $_POST[''.$name]??"";
        $heredoc = <<<HTML
            <div class="form-floating my-2">
                <select name="$name" id="floatingInput" class="form-select"  required>
                    <option value=""></option>
HTML;
                    foreach($options as $key=>$option){
                        if($selected == $key){
                            $heredoc .= "<option value='$key' selected>$option</option>";
                        }else{
                            $heredoc .= "<option value='$key'>$option</option>";
                        }
                        
                    }
                    $heredoc .= <<<HTML
                </select>
                <label for="floatingInput">$label</label>
            </div>
HTML;
        return $heredoc;
    }
}