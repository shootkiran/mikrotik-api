<?php

namespace Mikrotik\Commands\IP\Hotspot;

use Mikrotik\API\Talker\Talker,
    Mikrotik\API\Util\SentenceUtil;


class HotspotCookie {


    private $talker;

    function __construct(Talker $talker) {
        $this->talker = $talker;
    }


    public function delete($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/hotspot/cookie/remove");
        $sentence->where(".id", "=", $id);
        $enable = $this->talker->send($sentence);
        return "Sucsess";
    }


    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/hotspot/cookie/getall");
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No IP Hotspot Cookie To Set, Please Your Add IP Hotspot Cookie";
        }
    }


    public function detail($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/hotspot/cookie/print");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No IP Hotspot Cookie With This id = " . $id;
        }
    }

}
