<?php

	session_start();

	$image=imagecreatetruecolor(100, 30);
	$white=imagecolorallocate($image,255,255,255);//#ffffff
	imagefill($image,0,0,$white);

	/*//设置随机数字
	for($i=0;$i<4;$i++){
		$fontsize=6;
	    $fontcolor=imagecolorallocate($image,rand(0,120),rand(0,120),rand(0,120));
		$fontcontent=rand(0,9);
		
		$x=25*$i+rand(5,10);
		$y=rand(5,10);
		
		imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
	}*/

	$captch_code='';

	//设置随机字母和数字混合
	for ($i=0;$i<4;$i++){ 
		$fontsize=6;
		$fontcolor=imagecolorallocate($image,rand(0,120),rand(0,120),rand(0,120));
		$data='abcdefghijkmnpqrstuvwxy3456789';
		$fontcontent=substr($data,rand(0,strlen($data)-1),1);

		$captch_code.=$fontcontent;

		$x=25*$i+rand(5,10);
		$y=rand(5,10);

		imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
	}

	$_SESSION['authcode']=$captch_code;

	//绘制噪点干扰
	for($i=0;$i<200;$i++){
		$pointcolor=imagecolorallocate($image,rand(50,200),rand(50,200),rand(50,200));
		imagesetpixel($image, rand(0,100), rand(0,100),$pointcolor);
	}

	//绘制直线干扰
	for($i=0;$i<3;$i++){
		$linecolor=imagecolorallocate($image,rand(80,220),rand(80,220),rand(80,220));
		imageline($image,rand(0,100),rand(0,30),rand(0,100),rand(0,30),$linecolor);
	}


	header('content-type:image/png');
	imagepng($image);


	//end
	imagedestroy($image);
