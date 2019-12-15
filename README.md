# kestrel-php-monitoring
Basic PHP suite for monitoring

Currently operational: (mac only so far, will be implementing linux and windows shortly)

Server data: 
    OS, Memory Usage, Load, CPU Usage, Disk Space. 

    Use: drop in a folder, use kestrel.php as endpoint, will return JSON giving the above.

    E.g. output: 

{"os":"Darwin","mem_used":"5.668G","mem_avail":"2.137G","mem_total":"7.806G","sys_load":[2.2900390625,2.099609375,2.2734375],"cpu_user":"3.84%","cpu_sys":"11.53%","cpu_idle":"84.61%","disks":{"disk1":{"used":"113.733G","avail":"136.836G","total":"250.79G"},"disk2":{"used":"104.144G","avail":"215.927G","total":"320.071G"}}}

-----

With the above completed, will move onto checking local and remote services, sites, etc. 