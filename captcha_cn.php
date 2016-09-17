<?php

	session_start();

	$image=imagecreatetruecolor(200, 60);
	$white=imagecolorallocate($image,255,255,255);//#ffffff
	imagefill($image,0,0,$white);

	$fontface='FZYTK.TTF';
	$data="的粉红色的疯狂的减肥的咖啡机的离开号写字楼房间的覅偶尔去围殴奇葩若儿海口市荣诶入门型参考如饿哦的热欧范儿我又是一个打底裤了简单看了霍建华带饿哦我回复你程序和速度快搜房饿哦日混新婚快乐发送合作方单反还是火车西克拉黑人女警察局的苦衷发虚假斯柯达大家分享";
	
	$strdb=str_split($data,3);
	$captch_code='';

	//设置随机汉字混合
	for ($i=0;$i<4;$i++){ 
		$fontcolor=imagecolorallocate($image,rand(0,120),rand(0,120),rand(0,120));
		$index=rand(0,count($strdb)-1);
		$cn=$strdb[$index];
		$captch_code.=$cn;

		imagettftext($image,mt_rand(20,24),mt_rand(-60,60),(40*$i+20),mt_rand(30,35),$fontcolor,$fontface,$cn);
	}

	$_SESSION['authcode']=$captch_code;

	//绘制噪点干扰
	for($i=0;$i<400;$i++){
		$pointcolor=imagecolorallocate($image,rand(50,200),rand(50,200),rand(50,200));
		imagesetpixel($image, rand(0,200), rand(0,60),$pointcolor);
	}

	//绘制直线干扰
	for($i=0;$i<3;$i++){
		$linecolor=imagecolorallocate($image,rand(80,220),rand(80,220),rand(80,220));
		imageline($image,rand(0,200),rand(0,60),rand(0,200),rand(0,60),$linecolor);
	}


	header('content-type:image/png');
	imagepng($image);


	//end
	imagedestroy($image);
