<?php
	/*
		.html�̃^�O��javaScript�S���͂������.txt�ɕϊ����郄�c
		�����̃f�B���N�g���w�肵���炻�̒��g�̃��c�ϊ����Ă����܂�
	*/
	$dir = 'J:/zemi/2011_research/1022sat/target/';

	function getdirtree ( $path )	{
    	if (!is_dir($path))	{	// �f�B���N�g���łȂ���� false ��Ԃ�
        	return false;
          echo '�t�H���_�p�X����悤';
    	}
    	$dir = array();    // �߂�l�p�̔z��
    	if ($handle = opendir($path)) {
			  $coco = 0;
        while (false !== ($file = readdir($handle))) { 
          if ('.' == $file || '..' == $file) {
            // �������g('.')�Ə�ʊK�w( '..')�̃f�B���N�g�������O����while���񂵑�����(continue())
            continue;
          }
          if (is_dir($path.'/'.$file)) {
            // �f�B���N�g���Ȃ�Ύ������g���Ăяo��
            $dir[$file] = getdirtree($path.'/'.$file);
         	} elseif (is_file($path.'/'.$file)) {
            // �t�@�C���Ȃ�΃p�X���i�[
            $dir[$file] = $path.'/'.$file;
					  $part = pathinfo($file);
            $fpathmoji = $dir[$file];
          }
					if( $part['extension']=="html" || $path['extension']=="htm" ) {
    				$texto = file_get_contents($fpathmoji);
		    		$texto = preg_replace("/<script.*?>.*?<\/script>/ims","",$texto);
            $texto = str_replace("><",">�@<",$texto);
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
