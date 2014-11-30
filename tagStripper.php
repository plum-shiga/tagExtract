<?php
	/*
		.htmlのタグとjavaScript全部はぎ取って.txtに変換するヤツ
		直下のディレクトリ指定したらその中身のヤツ変換していきます
	*/
	$dir = 'J:/zemi/2011_research/1022sat/target/';

	function getdirtree ( $path )	{
    	if (!is_dir($path))	{	// ディレクトリでなければ false を返す
        	return false;
          echo 'フォルダパス入れよう';
    	}
    	$dir = array();    // 戻り値用の配列
    	if ($handle = opendir($path)) {
			  $coco = 0;
        while (false !== ($file = readdir($handle))) { 
          if ('.' == $file || '..' == $file) {
            // 自分自身('.')と上位階層( '..')のディレクトリを除外してwhileを回し続ける(continue())
            continue;
          }
          if (is_dir($path.'/'.$file)) {
            // ディレクトリならば自分自身を呼び出し
            $dir[$file] = getdirtree($path.'/'.$file);
         	} elseif (is_file($path.'/'.$file)) {
            // ファイルならばパスを格納
            $dir[$file] = $path.'/'.$file;
					  $part = pathinfo($file);
            $fpathmoji = $dir[$file];
          }
					if( $part['extension']=="html" || $path['extension']=="htm" ) {
    				$texto = file_get_contents($fpathmoji);
		    		$texto = preg_replace("/<script.*?>.*?<\/script>/ims","",$texto);
            $texto = str_replace("><",">　<",$texto);
    				$texto = strip_tags($texto);    
            $tikango = preg_replace("/:/","-",$fpathmoji);
	    			$tikango = preg_replace("/\\\/","#",$tikango);
		    		$tikango = preg_replace("/\//","$",$tikango);
            file_put_contents("J:/zemi/2011_research/1022sat/target/".$tikango.".txt",$texto);
					}
        }
        closedir($handle);
    	}
    	return $dir;
	}
	$tree = getdirtree($dir);
?>
