<?php

// helper function to format bytes values
function bytesFormat($bytes) {
    $bytes = (float)$bytes;
    if ($bytes < 1024) { return $bytes; }

    if ($bytes >= 1024 && $bytes < 1048576) { return round($bytes / 1000, 3) . "K"; }
    if ($bytes >= 1048576 && $bytes < 1073741824) { return round($bytes / 1000000, 3) . "M"; }
    if ($bytes >= 1073741824 && $bytes < 1099511627776) { return round($bytes / 1000000000, 3) . "G"; }
    if ($bytes >= 1099511627776 && $bytes < 1125899906842624)  { return round($bytes / 1000000000000, 3) . "P"; }

    // can use these figures instead if you want, just comment above and uncomment this. Above is default as it's what is usually expected.
    // if ($bytes >= 1024 && $bytes < 1048576) { return round($bytes / 1024, 3) . "K"; }
    // if ($bytes >= 1048576 && $bytes < 1073741824) { return round($bytes / 1048576, 3) . "M"; }
    // if ($bytes >= 1073741824 && $bytes < 1099511627776) { return round($bytes / 1073741824, 3) . "G"; }
    // if ($bytes >= 1099511627776 && $bytes < 1125899906842624)  { return round($bytes / 1125899906842624, 3) . "P"; }
}

// TODO: implement other OSs besides Darwin
    // php_uname('s');
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

// gets memory data from system
// NOTES: windows : systeminfo
// NOTES: linux use /proc...
function getMemData($os) {
    if ($os == "Darwin") {
        $resources = getrusage(2);
        $max_mem = ($resources["ru_maxrss"] * 1024);
        
        // get free mem
        $mem_free = shell_exec('vm_stat | grep "free.*" | grep -o "[0-9]*\.$"');
        $mem_free = (float)substr($mem_free, 0, strlen($mem_free) - 1);
        $mem_free = $mem_free * 4096;

        // get inactive mem
        $mem_inactive = shell_exec('vm_stat | grep "inactive.*" | grep -o "[0-9]*\.$"');
        $mem_inactive = (float)substr($mem_inactive, 0, strlen($mem_inactive) - 1);
        $mem_inactive = $mem_inactive * 4096;

        return array($max_mem - ($mem_free + $mem_inactive), $mem_free + $mem_inactive, $max_mem);
    } else if ($os == "") {

    } else {

    }
}

// returns 1, 5 and 15 min system load as array - build in PHP so works on cross-platform
function getSysLoad() {
    return sys_getloadavg();
}

// returns user, system and idle cpu time as %s. 
function getSysCPUData($os) {
    if ($os == "Darwin") {
        $stringData = shell_exec('top -l 1 -n 0');
        preg_match_all('/[0-9\.]+%/',$stringData, $cpuData);
        return $cpuData[0];
    } else if ($os == "") {

    } else {

    }
}

function getSysDiskData($os) {
    if ($os == "Darwin") {
        $stringData = shell_exec('df | grep disk');
        $diskData = array();
        $disks = explode("\n",$stringData);
        foreach($disks as $disk) {
            $data = explode("_", preg_replace('/[ ]+/','_',$disk));
            preg_match('/(disk[0-9]+)/', $data[0], $thisDisk);
            if ($thisDisk[0] == "" || empty($thisDisk[0])) { continue; }
            if (!isset($diskData[$thisDisk[0]])) { $diskData[$thisDisk[0]] = array(); }
                 
            $diskData[$thisDisk[0]]['used'] += ((int)$data[2] * 512);
            $diskData[$thisDisk[0]]['avail'] = ((int)$data[3] * 512);
            $diskData[$thisDisk[0]]['total'] = ((int)$data[1] * 512);
        }
        foreach ($diskData as &$dd) {
            $dd['used'] = bytesFormat($dd['used']);
            $dd['avail'] = bytesFormat($dd['avail']);
            $dd['total'] = bytesFormat($dd['total']);
        }
        return $diskData;
    } else if ($os = "") {

    } else {

    }
}
?>