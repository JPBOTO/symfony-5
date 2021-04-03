<?php

namespace App\Controller;
class  myfct {
	public static function demo($text=''){
		if($text){
			$html= "<h1>$text</h1>";
		}else{
			
			$html= "<h1>Bonjour tout le monde</h1>";
		}
		return $html;
		
	}
	
	
	
	
	
	
	
}





?>