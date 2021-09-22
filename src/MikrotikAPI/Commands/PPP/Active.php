<?php

namespace MikrotikAPI\Commands\PPP;

use MikrotikAPI\Util\SentenceUtil,
    MikrotikAPI\Talker\Talker;


class Active {

    private $talker;

    function __construct(Talker $talker) {
        $this->talker = $talker;
    }

    
    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ppp/active/getall");
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No PPP Active To Set, Please Your Add PPP Active";
        }
    }

    public function detail($name){
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ppp/active/print");
        $sentence->where('name','=',$name);
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No PPP Active with name $name found";
        }
    }
    public function delete($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ppp/active/remove");
        $sentence->where(".id", "=", $id);
        $enable = $this->talker->send($sentence);
        return "Sucsess";
    }

}
