<?php

namespace MikrotikAPI\Commands\File;

use MikrotikAPI\Util\SentenceUtil,
    MikrotikAPI\Talker\Talker;


class File {


    private $talker;

    function __construct(Talker $talker) {
        $this->talker = $talker;
    }


    public function get_all_file() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/file/getall");
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No File";
        }
    }


    public function detail_file($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/file/print");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No File With This id = " . $id;
        }
    }


    public function delete_file($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/file/remove");
        $sentence->where(".id", "=", $id);
        $enable = $this->talker->send($sentence);
        return "Sucsess";
    }

}
