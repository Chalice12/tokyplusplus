<?php
 
function get_operating_system($ua)
 {  
    $os1  = "Unknown";
 
    $os_a =  array
    (
            '/PlayStation 4/i'      =>  'Playstation 4',
            '/PlayStation Vita/i'   =>  'Playstation Vita',
			'/CrOS/i'               =>  'Chrome OS',
			'/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 10.0/i'    =>  'Windows 10',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile',
            '/New Nintendo 3DS/i'   =>  'New Nintendo 3DS'
        );
 
    foreach ($os_a as $key => $value) { 
 
        if (preg_match($key, $ua )) {
            $os1    =   $value;
        }
 
    }
	
	if (strpos($ua, "(toky++ web)") !== false) {
		$os1 = $os1 . ", toky++";
	}
 
    return $os1;
}

function is_phone($ua) {
$os1  = "false";
 
    $os_a =  array
    (
            '/iphone/i'             =>  'true',
            '/ipod/i'               =>  'true',
            '/ipad/i'               =>  'true',
            '/android/i'            =>  'true',
            '/blackberry/i'         =>  'true',
            '/webos/i'              =>  'true'
        );
 
    foreach ($os_a as $key => $value) { 
 
        if (preg_match($key, $ua )) {
            $os1    =   $value;
        }
 
    }
 
    return $os1;
}
?>