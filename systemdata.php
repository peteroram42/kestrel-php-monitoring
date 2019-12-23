<?php

namespace oram\kestrel;

class SystemData {
    var $os;            // e.g. "Darwin"
    var $mem_used;      // e.g. 2.104G
    var $mem_avail;     // e.g. 4.038G
    var $mem_total;     // e.g. 6.117G
    var $sys_load;      // e.g. [2.8779296875, 2.8955078125, 2.87744140625] - 1 min, 5 min, 15 min
    var $cpu_user;      // e.g. 3.5%
    var $cpu_sys;       // e.g. 10.84%
    var $cpu_idle;      // e.g. 86.10%
    var $disks;         // e.g. "disks":{"disk1":{"used":"105.908G","avail":"127.452G","total":"233.567G"},"disk2":{"used":"96.992G","avail":"201.098G","total":"298.089G"}}
    
    public function __construct() {
        $this->os = php_uname('s');
        $this->memPop();
        $this->getLoad();
        $this->getCPUData();
        $this->getDiskData();
    }

    public function update() {
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
        $this->sys_load = getSysLoad($this->os);
    }

    private function getCPUData() {
        $val = getSysCPUData($this->os);
        $this->cpu_user = $val[0];
        $this->cpu_sys = $val[1];
        $this->cpu_idle = $val[2];
    }

    private function getDiskData() {
        $this->disks = getSysDiskData($this->os);
    }
}
?>