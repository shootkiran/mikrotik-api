<?php

namespace MikrotikAPI\Commands\IP;

use MikrotikAPI\Talker\Talker,
    MikrotikAPI\Util\SentenceUtil;


class ARP {

    
    private $talker;

    function __construct(Talker $talker) {
        $this->talker = $talker;
    }

    
    public function add($param) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/arp/add");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $this->talker->send($sentence);
        return "Sucsess";
    }

    
    public function delete($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/arp/remove");
        $sentence->where(".id", "=", $id);
        $enable = $this->talker->send($sentence);
        return "Sucsess";
    }

    
    public function enable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/arp/enable");
        $sentence->where(".id", "=", $id);
        $enable = $this->talker->send($sentence);
        return "Sucsess";
    }

    
    public function disable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/arp/disable");
        $sentence->where(".id", "=", $id);
        $disable = $this->talker->send($sentence);
        return "Sucsess";
    }

    
    public function set($param, $id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/arp/set");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return "Sucsess";
    }

    
    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/arp/getall");
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Ip ARP To Set, Please Your Add Ip ARP";
        }
    }

    
    public function detail($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/arp/print");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Ip ARP With This id = " . $id;
        }
    }

}
