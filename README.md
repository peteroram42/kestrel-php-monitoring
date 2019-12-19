# kestrel-php-monitoring
Basic PHP server monitoring

Current iteration supports server monitoring on Linux, Windows and mac OS. 

Drop all three files in directory on server and hit kestrel.php as endpoint. Default will return in JSON: OS, memory usage, load, CPU usage and disk space. Can also instantiate object and constructor will detect OS and build out data. Update method also available. 

    Example outpoint: 
    {"os":"Darwin","mem_used":"5.668G","mem_avail":"2.137G","mem_total":"7.806G","sys_load":[2.2900390625,2.099609375,2.2734375],"cpu_user":"3.84%","cpu_sys":"11.53%","cpu_idle":"84.61%","disks":{"disk1":{"used":"113.733G","avail":"136.836G","total":"250.79G"},"disk2":{"used":"104.144G","avail":"215.927G","total":"320.071G"}}}


Files are: 
`systemdata.php` is the class definition.
`kestrel-funcs.php` are the applicable functions
`kestrel.php` is the default endpoint to return the above JSON.

Include first two files above and use however else you'd like. 