<?php  
include 'curl.php';

function wp_creator(){
	$watpad = get('https://www.wattpad.com');
	$cookies = getcookies($watpad);

	$headers = [
		'Host: www.wattpad.com',
		'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:76.0) Gecko/20100101 Firefox/76.0',
		'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
		'Cookie: __cfduid='.$cookies['__cfduid'].'; wp_id='.$cookies['wp_id'].'; sn__time=j%3Anull; fs__exp=1; lang=20; locale=id_ID;',
		'Accept-Language: id,en-US;q=0.7,en;q=0.3'
	];

	// Get random user
	$name_fake = get('https://name-fake.com/id_ID');
	preg_match('/<div class="subj_div_45g45gg" id="copy3">(.*?)<\/div>/s', $name_fake, $username);
	preg_match('/<div id="copy4">(.*?)<\/div>/s', $name_fake, $email);

	// Generate user
	$email = $username[1].number(4).'@gmail.com';
	$password = '@Yudhagans123';

	// Signup
	$signup = post('https://www.wattpad.com/signup?nextUrl=/home', 'signup-from=new_landing_undefined&form-type=&username='.$username[1].number(4).'&email='.$email.'&password='.$password.'&month=08&day=11&year=1994', $headers);

	if (stripos($signup, '/start/writerjourney')) {

		echo $data = "Success | ".$email." | ".$password."\n";
		echo "Delay 5 seconds\n";
		sleep(5);
		$fh = fopen("wattpad.txt", "a");
		fwrite($fh, $data);
		fclose($fh);

	} else {
		echo "Failed | ".$email." | ".$password."\n";
	}
}

echo "Wattpad account creator\n";
echo "Created by https://www.facebook.com/yudha.t.pamungkas.3\n";
echo "How many u want to create? ";
$banyak = trim(fgets(STDIN));
for ($i = 0; $i < $banyak ; $i++) {
	wp_creator();
}
echo "Result save in wattpad.txt\n";


?>