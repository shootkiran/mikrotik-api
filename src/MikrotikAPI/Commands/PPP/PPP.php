<?php

namespace MikrotikAPI\Commands\PPP;

use MikrotikAPI\Talker\Talker;
use MikrotikAPI\Commands\PPP\Active,
    MikrotikAPI\Commands\PPP\Secret,
    MikrotikAPI\Commands\PPP\AAA,
    MikrotikAPI\Commands\PPP\Profile;


class PPP {

    private $talker;

    function __construct(Talker $talker) {
        $this->talker = $talker;
    }

    
    public function profile() {
        return new Profile($this->talker);
    }

    
    public function secret() {
        return new Secret($this->talker);
    }

    
    public function AAA() {
        return new AAA($this->talker);
    }

    
    public function active() {
        return new Active($this->talker);
    }

}
