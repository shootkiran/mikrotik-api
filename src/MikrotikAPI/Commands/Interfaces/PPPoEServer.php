<?php

namespace MikrotikAPI\Commands\Interfaces;

use MikrotikAPI\Util\SentenceUtil,
    MikrotikAPI\Talker\Talker;


class PPPoEServer {

    
    private $talker;

    function __construct(Talker $talker) {
        $this->talker = $talker;
    }

    
    public function add($param) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/interface/pppoe-server/server/add");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $this->talker->send($sentence);
        return "Sucsess";
    }

    
    public function disable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/interface/pppoe-server/server/disable");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return "Sucsess";
    }

    
    public function enable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/interface/pppoe-server/server/enable");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return "Sucsess";
    }

    
    public function set($param, $id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/interface/pppoe-server/server/set");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return "Sucsess";
    }

    
    public function delete($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/interface/pppoe-server/server/remove");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return "Sucsess";
    }

    
    public function get_all() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/interface/pppoe-server/server/getall");
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Interface PPPoE-Server Server To Set, Please Your Add Interface PPPoE-Server Server";
        }
    }

    
    public function detail($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/interface/pppoe-server/server/print");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Interface PPPoE-Server Server With This id = " . $id;
        }
    }

}
