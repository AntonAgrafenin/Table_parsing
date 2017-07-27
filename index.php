<?php
header('Content-type: text/html; charset=utf-8');
require 'phpQuery.php';

function print_arr($arr){
	echo '<pre>' . print_r($arr, true) . '</pre>';
}

$url = 'table1.html';
$file = file_get_contents($url);

$doc = phpQuery::newDocument($file);

/*
foreach($doc->find('.articles-container .post-excerpt') as $article){
	$article = pq($article);

	// $article->find('.cat')->remove();
	// $article->find('.cat')->prepend('Категория: ');
	$article->find('.cat')->wrap('<div class="category">')->after('Дата: ' . date("Y-m-d H:i:s"));

	$img = $article->find('.img-cont img')->attr('src');
	$text = $article->find('.pd-cont')->html();
	
	echo "<img src='$img'>";
	echo $text;
	echo '<hr>';
}*/
//$links = $doc->find('td');
$links = $doc->find('tr');


//print_arr($links);
//var_dump($links);
$info1 = array();
$bloktd = array();
$blokb = array();

echo " === === ";
    $i=0;
    foreach ($links as $l) {
 
       $pqLink = pq($l); //pq делает объект phpQuery
       //$s = $pqLink->text();
	   $s = $pqLink->html();
	
	   
      // if ($i==7) {
	  // $j++;
	  // $i=0;
	  // }
      //mysqli_query($link, "insert into motor5 (`1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`) values('$a', '$b','$c','$d','$e','$f','$g','$h','$j','$k')");
      // echo "=> ". $a . " ". $b . " ". $c . " ". $d . " ". $e . " ". $f . " ". $g . " <=<br>";
	   
	  // $info1[$j][$i] = $s;
	  $info1[$i][0] = $s;
	  $info1[$i][1] = strlen($s);
	  
	  $s2td = pq($pqLink)->find('td')->html();
	  
	  $info2td[$i][0] = $s2td;
	  
	  $s3p = pq($pqLink)->find('p')->text();
	  
	  $info3p[$i][0] = $s3p;
	  
	  
	  //$bloktd= pq($s)->find('td')->html();
	  
	  //preg_match_all('!(\[td\])(.*?)(\[/td\])!ise',$s, $matches);
	  
	  
	  //for($n = 0; $n < count($pqLink);$n++){
	//	$blokb[$i][] = $pqLink;
	  //}
	  
	  //$blokb[$i][] = $pqLink;
	  

	  

	  //echo "=> ". $s;
	   
	  // $i=0;
      // }
      // if ($i==0) $a=$s;
      // if ($i==1) $b=$s;
      // if ($i==2) $c=$s;
      // if ($i==3) $d=$s;
      // if ($i==4) $e=$s;
     //  if ($i==5) $f=$s;
     //  if ($i==6) $g=$s;
       //if ($i==7) $h=$s;
       //if ($i==8) $j=$s;
       //if ($i==9) $k=$s;
 
       $i++;
    }
	
	//Выделили все td
	//echo "=----- выделили все td ---------- ";
	//print_arr($info1);
	//echo "=--------------- ";
	
	//Выделили все p
	//echo "==----- Выделили все p ---------- ";
	//print_arr($info2td);
	
	//echo "==-------------- ";
	//echo "==--- Выделили все тексты в p ----------- ";
	//Выделили все тексты в p
	//print_arr($info3p);
	
	//Разбивка строки на подстроки
	//$info1
	$mastd = array();
	$searchtd = array();
	
	for ($x=0; $x<count($info1); $x++){
		//echo $x;
		$temp = $info1[$x][0];
		
		$mastd[$x] = explode('<', $temp, -1);
		
	}
	
	// выделение ячеек td
	echo "== red0 -------------- <br>";
	$tdcount =0;
	
	$tdcountarr = array();
	
	for ($x=0; $x<count($info1); $x++){
		
		for ($y=0; $y<count($mastd[$x]); $y++){
			//$tm = $mastd[$x][$y];
			//$key = substr($tm, 0, 3); 
			//$tegstart = strcmp($key, 'td'); 
			//$tegend = strcmp($key, '/td'); 
			
			$tegstart = strcmp(substr($mastd[$x][$y], 0, 3), 'td');
			
			if($tegstart==1) {
				//$rez = " start";
				$tdcount++;
			}else {$rez = " no";}
						
			//if($tegend=1) $rez = " end";
			
			//echo $y . " ". $tm . "    =>". $key . "    === ". $rez . "<br>";
			//echo $y . "     === ". $rez . "<br>";
			 
			
		}
		$tdcountarr[$x] = $tdcount;
		$tdcount =0;
		

	}
	
	//echo "Count teg TD = " . $tdcount;
	//echo "<br>";
	print_arr($tdcountarr);
	
	
		
	echo "== red -------------- ";
	//print_arr($info3p);
	
	//Разбивка строки на подстроки
	//$info2td
	
	$mas2td = array();
	$search2td = array();
	
	for ($x=0; $x<count($info2td); $x++){

		$temp2 = $info2td[$x][0];
		
		$mas2td[$x] = explode('<', $temp2, -1);
		
	}
	
	
	//print_arr($mas2td);
	//print_arr($mas2td[0]);
	//print_arr($mas2td[1]);
	//print_arr($mas2td[2]);
	//print_arr($mas2td[10]);
	echo "Coutn M= " . count($mas2td);
	
	// вставка тегов в p
	echo "== red0 -------------- <br>";
	
	$tempmas =array();
	
	for ($x=1; $x<10; $x++){

		if(count($mas2td[$x])>13){
			$tmpteg1 = $mas2td[$x][3];
			$domain1 = substr(strstr($tmpteg1, '>'), 1);
			$temptgp1 = strstr($tmpteg1, '>', true);
			$temptgp1 = $temptgp1. ">";
			$newtgp1 = $temptgp1 . '<span itemprop="EduCode">'. $domain1 .'</span>';
			
			$tempmas[$x][0] = $newtgp1;
			$mas2td[$x][3] = $newtgp1;
			
			
			
			$tmpteg2 = $mas2td[$x][6];
			$tmpteg2b = $mas2td[$x][7];
			$domain2 = substr(strstr($tmpteg2, '>'), 1);
			$temptgp2 = strstr($tmpteg2, '>', true);
			$temptgp2 = $temptgp2. ">";
			$newtgp2 = $temptgp2 . '<span itemprop="EduLevel">'. $domain2 .'</span>';
			$newtgp2b = '<'. $tmpteg2b;
			$tempmas[$x][1] = $newtgp2;
			$tempmas[$x][2] = $newtgp2b;
			
			$mas2td[$x][6] = $newtgp2;
			$mas2td[$x][7] = $newtgp2b;
			
						
			$ncount = 10;
			
			$tegexist1 = strcmp(substr($mas2td[$x][$ncount], 0, 3), 'em');
			
			if($tegexist1==1) {
				$tmpteg3 = $mas2td[$x][$ncount];
				$tmpteg3b = $mas2td[$x][$ncount+1];
				$domain3 = substr(strstr($tmpteg3, '>'), 1);
				$temptgp3 = strstr($tmpteg3, '>', true);
				$temptgp3 = $temptgp3. ">";
				
				$ncount = $ncount+4;
			}
			else {
				
				$temptgp3 = "";
				$domain3 = "";
				$tmpteg3b ="";
				$ncount = $ncount+1;
			}
			
			//=== редактир 
			if(! empty($temptgp3)){
				$newtgp3 = $temptgp3 . '<span itemprop="LearningTerm">'. $domain3 .'</span>';
				$newtgp3b = '<'. $tmpteg3b;
				
				
				$tempmas[$x][3] = $newtgp3;
				$tempmas[$x][4] = $newtgp3b;
			}else{
				$tempmas[$x][3] = "";
				$tempmas[$x][4] = "";	
			}
			
			//=================
			
			$tegexist2 = strcmp(substr($mas2td[$x][$ncount], 0, 3), 'em');
			
			if($tegexist2==1) {
				$tmpteg4 = $mas2td[$x][$ncount];
				$tmpteg4b = $mas2td[$x][$ncount+1];
				$domain4 = substr(strstr($tmpteg4, '>'), 1);
				$temptgp4 = strstr($tmpteg4, '>', true);
				$temptgp4 = $temptgp4. ">";
				
				$ncount = $ncount+4;
			}
			else {
				
				$temptgp4 = "";
				$domain4 = "";
				$tmpteg4 ="";
				$tmpteg4b ="";
				$ncount = $ncount+2;
			}
			
			
			
			
			
			$tegexist3 = strcmp(substr($mas2td[$x][$ncount], 0, 3), 'em');
			
			if($tegexist3==1) {
				$tmpteg5 = $mas2td[$x][$ncount];
				$tmpteg5b = $mas2td[$x][$ncount+1];
				$domain5 = substr(strstr($tmpteg5, '>'), 1);
				$temptgp5 = strstr($tmpteg5, '>', true);
				$temptgp5 = $temptgp5. ">";
				
				$ncount = $ncount+3;
			}
			else {
				
				$temptgp5 = "";
				$domain5 = "";
				$tmpteg5 ="";
				$tmpteg5b ="";
				$ncount = $ncount+1;
			}
			
			
			$tmpteg6 = $mas2td[$x][$ncount];
			//$tmpteg6b = $mas2td[$x][$ncount+1];
			$domain6 = substr(strstr($tmpteg6, '>'), 1);
			$temptgp6 = strstr($tmpteg6, '>', true);
			$temptgp6 = $temptgp6. ">";
			$ncount = $ncount+3;
			
			//$ncount = 21 | 19;
			$tmpteg7 = $mas2td[$x][$ncount];
			$tmpteg7b = $mas2td[$x][$ncount+1];
			$domain7 = substr(strstr($tmpteg7, '>'), 1);
			$temptgp7 = strstr($tmpteg7, '>', true);
			$temptgp7 = $temptgp7. ">";
			$ncount = $ncount+2;
			
			
			
			
					
			
			//===========================
			//echo "X= ". $x;
			//echo "<br>";
			//echo $domain;
			//echo "<br>";
			//echo $temptgp;
			//echo "<br>";
			//echo 'res= ';
			//echo '<span itemprop="EduCode">'. $domain .'</span>';
			
						
			
			
			
			
			
			
			
			
			if(! empty($temptgp4)){
				$newtgp4 = $temptgp4 . '<span itemprop="LearningTerm">'. $domain4 .'</span>';
				$newtgp4b = '<'. $tmpteg4b;
							
				$tempmas[$x][5] = $newtgp4;
				$tempmas[$x][6] = $newtgp4b;
			}else{
				$tempmas[$x][5] = "";
				$tempmas[$x][6] = "";	
			}
			
			if(! empty($temptgp5)){
				$newtgp5 = $temptgp5 . '<span itemprop="LearningTerm">'. $domain5 .'</span>';
				$newtgp5b = '<'. $tmpteg5b;
							
				$tempmas[$x][7] = $newtgp5;
				$tempmas[$x][8] = $newtgp5b;
			}else{
				$tempmas[$x][7] = "";
				$tempmas[$x][8] = "";	
			}
			
			$newtgp6 = $temptgp6 . '<span itemprop="language">'. $domain6 .'</span>';
			//$newtgp6b = '<'. $tmpteg6b;
			
			$tempmas[$x][9] = $newtgp6;
			//$tempmas[10] = $newtgp6b;
			
			$newtgp7 = $temptgp7 . '<span itemprop="DateEnd">'. $domain7 .'</span>';
			$newtgp7b = '<'. $tmpteg7b;

			
			$tempmas[$x][10] = $newtgp7;
			$tempmas[$x][11] = $newtgp7b;
			
		}
		
		
	}
	
	
	print_arr($tempmas);
	
	echo "== red1 -------------- <br>";
	
	//print_arr($mas2td);
	
	for ($x=0; $x<count($mas2td); $x++){

		for ($y=1; $y<count($mas2td[$x]); $y++){

		$mas2td[$x][$y] = "<" . $mas2td[$x][$y];
		
		
		}	
	}		
	
	print_arr($mas2td);
	
	//Выделили все td
	echo "=----- выделили все td ---------- ";
	print_arr($info1);
	//echo "=--------------- ";
	
	//Выделили все p
	//echo "==----- Выделили все p ---------- ";
	//print_arr($info2td);
	
	
	
	
	//$tdcount =0;
	
	//$tdcountarr = array();
	
/* 	for ($x=0; $x<3; $x++){
		
		for ($y=0; $y<count($mastd[$x]); $y++){
			//$tm = $mastd[$x][$y];
			//$key = substr($tm, 0, 3); 
			//$tegstart = strcmp($key, 'td'); 
			//$tegend = strcmp($key, '/td'); 
			
			$tegstart = strcmp(substr($mastd[$x][$y], 0, 3), 'td');
			
			if($tegstart==1) {
				$rez = " start";
				$tdcount++;
			}else {$rez = " no";}
						
			//if($tegend=1) $rez = " end";
			
			//echo $y . " ". $tm . "    =>". $key . "    === ". $rez . "<br>";
			//echo $y . "     === ". $rez . "<br>";
			 
			
		}
		$tdcountarr[$x] = $tdcount;
		$tdcount =0;
		

	} */
	
/* 	echo "Count teg TD = " . $tdcount;
	echo "<br>";
	print_arr($tdcountarr); */
	
	//print_arr($mastd);
	
	
	
	
	

