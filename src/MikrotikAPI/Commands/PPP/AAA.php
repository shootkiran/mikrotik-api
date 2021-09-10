<?php

namespace MikrotikAPI\Commands\PPP;

use MikrotikAPI\Util\SentenceUtil,
    MikrotikAPI\Talker\Talker;


class AAA {

    
    private $talker;

    function __construct(Talker $talker) {
        $this->talker = $talker;
    }

    
    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ppp/aaa/getall");
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No PPP AAA To Set, Please Your Add PPP AAA";
        }
    }

    
    public function set($use_radius, $accounting, $interim_update) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ppp/aaa/set");
        $sentence->setAttribute("use-radius", $use_radius);
        $sentence->setAttribute("accounting", $accounting);
        $sentence->setAttribute("interim-update", $interim_update);
        $this->talker->send($sentence);
        return "Sucsess";
    }

}
