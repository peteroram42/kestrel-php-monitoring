<?php

class SystemData {
    var $os;
    var $mem_used;
    var $mem_avail;
    var $mem_total;
    var $sys_load;
    var $cpu_user;
    var $cpu_sys;
    var $cpu_idle;
    var $disk_used;
    var $disk_free;
    var $disk_total;

    public function __construct() {
        $this->os = php_uname('s');
        $this->memPop();
        $this->getLoad();
        $this->getCPUData();
        $this->getDiskData();
    }

    private function memPop() {
        $val = getMemData($this->os);
        $this->mem_used = bytesFormat($val[0]);
        $this->mem_avail = bytesFormat($val[1]);
        $this->mem_total = bytesFormat($val[2]);
    }

    private function getLoad() {
        $this->sys_load = getSysLoad();
    }

    private function getCPUData() {

    }

    private function getDiskData() {

    }
}

?>