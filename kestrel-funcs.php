<?php

// gets memory data from system
// TODO: implement other OSs besides Darwin
// TODO: pull string as total memory on test computer is 4G as that's total of free, active, inactive - but have 8G RAM.
        // implement getrusage(2)
    // php_uname('s');
    // Darwin

    // Linux

    // WINNT
    // WIN32
    // Windows

    // FreeBSD
    // NetBSD
    // OpenBSD

    // Unix
    // SunOS

    // DragonFly
    // CYGWIN_NT-5.1
    // HP-UX
    // IRIX64
function getMemData($os) {
    if ($os == "Darwin") {
        // get free mem
        $mem_free = shell_exec('vm_stat | grep "free.*" | grep -o "[0-9]*\.$"');
        $mem_free = (float)substr($mem_free, 0, strlen($mem_free) - 1);
        $mem_free = $mem_free * 4096;

        // get inactive mem
        $mem_inactive = shell_exec('vm_stat | grep "inactive.*" | grep -o "[0-9]*\.$"');
        $mem_inactive = (float)substr($mem_inactive, 0, strlen($mem_inactive) - 1);
        $mem_inactive = $mem_inactive * 4096;

        // get wired down mem
        $mem_wdown = shell_exec('vm_stat | grep "wired.*" | grep -o "[0-9]*\.$"');
        $mem_wdown = (float)substr($mem_wdown, 0, strlen($mem_wdown) - 1);
        $mem_wdown = $mem_wdown * 4096;

        // get active mem
        $mem_active = shell_exec('vm_stat | grep "active.*" | grep -o "[0-9]*\.$"');
        $mem_active = (float)substr($mem_active, 0, strlen($mem_active) - 1);
        $mem_active = $mem_active * 4096;

        return array($mem_active, $mem_free + $mem_inactive + $mem_wdown, $mem_free + $mem_active + $mem_inactive + $mem_wdown);
    } else if ($os == "") {

    } else if ($os == "") {

    } else {

    }
}

// helper function to format bytes values
function bytesFormat($bytes) {
    $bytes = (float)$bytes;
    if ($bytes < 1024) { return $bytes; }
    if ($bytes >= 1024 && $bytes < 1048576) { return round($bytes / 1024, 3) . "K"; }
    if ($bytes >= 1048576 && $bytes < 1073741824) { return round($bytes / 1048576, 3) . "M"; }
    if ($bytes >= 1073741824 && $bytes < 1099511627776) { return round($bytes / 1073741824, 3) . "G"; }
    if ($bytes >= 1099511627776 && $bytes < 1125899906842624)  { return round($bytes / 1125899906842624, 3) . "P"; }
}

// returns 1, 5 and 15 min system load as array
function getSysLoad() {
    return sys_getloadavg();
}

?>