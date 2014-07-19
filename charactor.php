<?php

class Charactor {
    private $name;
    private $title;
    private $date_m;
    private $date_d;

    public function __construct($name, $title, $date_m, $date_d)
    {
        $this->name = $name;
        $this->title = $title;
        $this->date_m = $date_m;
        $this->date_d = $date_d;
    }

    public function get_name()
    {
        return $this->name;
    }
    public function set_name($name)
    {
        $this->name = $name;
    }
    public function get_atitle()
    {
        return $this->title;
    }
    public function set_atitle($title)
    {
        $this->title = $title;
    }
    public function get_date_m()
    {
        return $this->date_m;
    }
    public function set_date_m($date_m)
    {
        $this->date_m = $date_m;
    }
    public function get_date_d()
    {
        return $this->date_d;
    }
    public function set_date_d($date_d)
    {
        $this->date_d = $date_d;
    }
}
