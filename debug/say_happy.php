<?php
require_once('../class/charactor.php');

class SayHappy {
    private $url_format = 'http://www.fan-web.jp/day/sayhappy_sp.cgi';
    private $charactors = array();
    public function __construct()
    {
        $this->run();
    }

    public function get_charactors() {
        return $this->charactors;
    }

    public function run()
    {
        for ($i = 1; $i <= 12; $i++) {
            $this->crawl_char($i);
        }
    }

    public function crawl_char($i)
    {
        $url = $this->url_format . '?month=' . $i . '&day=1';
        $f = mb_convert_encoding(file_get_contents($url, 'sjis'), 'utf8', 'sjis');
        $regex = "#center>(.*)日.*crimson>(.*)</font>\((.*)\)</td>#uU";
        preg_match_all($regex, $f, $m, PREG_SET_ORDER);
        foreach ($m as $v) {
            $this->charactors[] = new Charactor($v[2], $v[3], $i, $v[1]);
        }
    }
}
