<?php

class Password
{

    private $length;
    private $args;
    private $quantity;
    private $passwords = array();
    private $lowerChars = "pdewjkoyzfghqrxbcistualmnv"; // include_lower_chars
    private $upperChars = "JOVWXKDLMNUAYZSTPQRGHIBCEF"; // include_upper_chars
    private $numericChars = "3598120476"; // include_numeric_chars
    private $specialChars = ":;#=_~%$.,*-+/@!?}{][)("; // include_special_chars

    public function __construct($_quantity = 1, $_length = 24, $_args = array('include_lower_chars', 'include_upper_chars', 'include_numeric_chars', 'include_special_chars')) {
        $this->length = $_length;
        $this->args = $_args;
        $this->quantity = $_quantity;
        if(!empty($_args)) {
            $this->generate();
        }
    }

    protected function generate() {
        for($i = 0;$i < $this->quantity;$i++){
            $this->shuffle(['lowerChars', 'upperChars', 'numericChars', 'specialChars']);
            $generated = '';
            if (in_array("include_lower_chars", $this->args)) {
                $generated = str_shuffle($generated . $this->lowerChars);
            }
            if (in_array("include_upper_chars", $this->args)) {
                $generated = str_shuffle($generated . $this->upperChars);
            }
            if (in_array("include_numeric_chars", $this->args)) {
                $generated = str_shuffle($generated . $this->numericChars);
            }
            if (in_array("include_special_chars", $this->args)) {
                $generated = str_shuffle($generated . $this->specialChars);
            }
            $generated = substr($generated, 0, -(strlen($generated) - $this->length));
            array_push($this->passwords, $generated);
        }
    }

    public function getJSON() {
        $json["passwords"] = $this->passwords;
        $json["creationDate"] = time();
        $json["length"] = $this->length;
        $json["quantity"] = $this->quantity;
        $json = json_encode($json);
        return $json;
    }

    public function shuffle($_shuffles) {
        foreach($_shuffles as $key => $value) {
            $this->$value = str_shuffle($this->$value);
        }
    }

    public function showPassword() {
        return $this->passwords[0];
    }

}