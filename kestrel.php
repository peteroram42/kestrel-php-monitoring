<?php

require_once("systemdata.php");
require_once("kestrel-funcs.php");

// windows : systeminfo
// mac use python (review/fix script)
// linux use /proc...

$sd = new SystemData;

echo json_encode($sd) . "\n";

// SnowStorm:kestrel-php-monitoring Peter$ top -l 1 -n 0
// CPU usage: 4.81% user, 12.22% sys, 82.96% idle

// SnowStorm:kestrel-php-monitoring Peter$ df
// Filesystem    512-blocks      Used Available Capacity iused      ifree %iused  Mounted on
// /dev/disk1s5   489825072  21155248 270503680     8%  484096 2448641264    0%   /
// devfs                681       681         0   100%    1178          0  100%   /dev
// /dev/disk1s1   489825072 190413768 270503680    42% 1211242 2447914118    0%   /System/Volumes/Data
// /dev/disk1s4   489825072   6293544 270503680     3%       4 2449125356    0%   /private/var/vm
// map auto_home          0         0         0   100%       0          0  100%   /System/Volumes/Data/home
// /dev/disk1s3   489825072   1026240 270503680     1%      32 2449125328    0%   /Volumes/Recovery

?>