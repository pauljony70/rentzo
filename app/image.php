<?php
class Image{
  public function getImage($imagelink){ 
    $currentimestamp=date("d-m-Y");
                    //$media_path=constant("path");
                    list($width,$height)=getimagesize($imagelink['image']['tmp_name']);
                    $nwidth=$width/3;
                    $nheight=$height /3;
                    $nwidth1=$width/2;
                    $nheight1=$height/2;
                    $nwidth2=$width/ 1.5;
                    $nheight2=$height/1.5;
                    $nwidth3= $width/1.2;
                    $nheight3= $height /1.2;
                    $newimage=imagecreatetruecolor($nwidth,$nheight);
                    $name=explode('.',$imagelink['image']['name']);
                    $file_ext=end($name);

                   $currentdate=date("d-m-Y");
                        if (!file_exists("../../../../media/$currentdate".'/')) {
                            mkdir("../../../../media/$currentdate".'/', 0777, true);
                        }
                        $folder_path="../../../../media/$currentdate".'/';			
                    //print($folder_path);
                    //die();
                    $newimage1=imagecreatetruecolor($nwidth1,$nheight1);
                    $newimage2=imagecreatetruecolor($nwidth2,$nheight2);
    				$newimage3=imagecreatetruecolor($nwidth3,$nheight3);
                    if($imagelink['image']['type']=='image/jpeg'){
                        $source=imagecreatefromjpeg($imagelink['image']['tmp_name']);
                        imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
                        imagecopyresized($newimage1,$source,0,0,0,0,$nwidth1,$nheight1,$width,$height);
                        imagecopyresized($newimage2,$source,0,0,0,0,$nwidth2,$nheight2,$width,$height);
                        imagecopyresized($newimage3,$source,0,0,0,0,$nwidth3,$nheight3,$width,$height);
                        
						
                        $file_name=$name[0].'-'.time().'-200-200'.'.'.$file_ext;
                        $file_name1=$name[0].'-'.time().'-400-400'.'.'.$file_ext;
                        $file_name_database=$name[0].'-'.time().'.'.$file_ext;
                        $file_name2=$name[0].'-'.time().'-800-800'.'.'.$file_ext;
                        $file_name3=$name[0].'-'.time().'-600-1400'.'.'.$file_ext;
                        
                      	$file_name=str_replace(' ', '', $file_name);
                        $file_name1=str_replace(' ', '', $file_name1);
                        $file_name2=str_replace(' ', '', $file_name2);
                        $file_name3=str_replace(' ', '', $file_name3);
                      
                        $original_file=$name[0].'-'.time().'.'.$file_ext;
                        $original_file=str_replace(' ', '', $original_file);
                     //   $original_file=str_replace(' ','',$original_file);
                        $file_name_database=str_replace(' ', '', $file_name_database);
                        imagejpeg($newimage,$folder_path.$file_name);
                        imagejpeg($newimage1,$folder_path.$file_name1);
                        imagejpeg($newimage2,$folder_path.$file_name2);
                        imagejpeg($newimage3,$folder_path.$file_name3);
                     
                      move_uploaded_file($imagelink['image']['tmp_name'],$folder_path.$original_file);
                           
                     //   imagejpeg($imagelink['image']['name'],'../media/'.$original_file);
                        return $file_name_database;
                    }elseif($imagelink['image']['type']=='image/png'){
                        $source=imagecreatefrompng($imagelink['image']['tmp_name']);
                        imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
                        imagecopyresized($newimage1,$source,0,0,0,0,$nwidth1,$nheight1,$width,$height);
                        imagecopyresized($newimage2,$source,0,0,0,0,$nwidth2,$nheight2,$width,$height);
                        imagecopyresized($newimage3,$source,0,0,0,0,$nwidth3,$nheight3,$width,$height);
                         
                        $file_name=$name[0].'-'.time().'-200-200'.'.'.$file_ext;
                        $file_name1=$name[0].'-'.time().'-400-400'.'.'.$file_ext;
                        $file_name_database=$name[0].'-'.time().'.'.$file_ext;
                        $file_name2=$name[0].'-'.time().'-800-800'.'.'.$file_ext;
                        $file_name3=$name[0].'-'.time().'-600-1400'.'.'.$file_ext;
                        
                        $original_file=$name[0].'-'.time().'.'.$file_ext;
                      $original_file=str_replace(' ', '', $original_file);
                        //print($file_name);print($file_name1);print($file_name2);
                        $file_name=str_replace(' ', '', $file_name);
                        $file_name1=str_replace(' ', '', $file_name1);
                        $file_name2=str_replace(' ', '', $file_name2);
                        $file_name3=str_replace(' ', '', $file_name3);
                      
                    //  $original_file=str_replace(' ','',$original_file);
                        $file_name_database=str_replace(' ', '', $file_name_database);
                        imagepng($newimage,$folder_path.$file_name);
                        imagepng($newimage1,$folder_path.$file_name1);
                        imagepng($newimage2,$folder_path.$file_name2);
                        imagepng($newimage3,$folder_path.$file_name3);
                     
                        move_uploaded_file($imagelink['image']['tmp_name'],$folder_path.$original_file);
                        
                        
                      
                        return $file_name_database;
                    }elseif($imagelink['image']['type']=='image/gif'){
                        $source=imagecreatefromgif($imagelink['image']['tmp_name']);
                        imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
                        imagecopyresized($newimage1,$source,0,0,0,0,$nwidth1,$nheight1,$width,$height);
                        imagecopyresized($newimage2,$source,0,0,0,0,$nwidth2,$nheight2,$width,$height);
                        imagecopyresized($newimage3,$source,0,0,0,0,$nwidth3,$nheight3,$width,$height);
                         
                        $file_name=$name[0].'-'.time().'-200-200'.'.'.$file_ext;
                        $file_name1=$name[0].'-'.time().'-400-400'.'.'.$file_ext;
                        $file_name_database=$name[0].'-'.time().'.'.$file_ext;
                        $file_name2=$name[0].'-'.time().'-800-800'.'.'.$file_ext;
                        $file_name3=$name[0].'-'.time().'-600-1400'.'.'.$file_ext;
                          
                        $original_file=$name[0].'-'.time().'.'.$file_ext;
                        $file_name=str_replace(' ', '', $file_name);
                        $file_name1=str_replace(' ', '', $file_name1);
                        $file_name2=str_replace(' ', '', $file_name2);
                        $file_name3=str_replace(' ', '', $file_name3);
                      
                      $original_file=str_replace(' ', '', $original_file);
                      //$original_file=str_replace(' ','',$original_file);
                        $file_name_database=str_replace(' ', '', $file_name_database);
                        imagegif($newimage,$folder_path.$file_name);
                     // imagejpeg($imagelink['image']['name'],'../media/'.$original_file);
                        imagegif($newimage1,$folder_path.$file_name1);
                        imagegif($newimage2,$folder_path.$file_name2);
                        imagegif($newimage3,$folder_path.$file_name3);
                      
                      move_uploaded_file($imagelink['image']['tmp_name'],$folder_path.$original_file);
                        return $file_name_database;
                    }else{
                        return "false";
                    }
}
public function getImage1($imagelink){ 
  $currentimestamp=date("d-m-Y");
  //$media_path=constant("path");
  list($width,$height)=getimagesize($imagelink['image1']['tmp_name']);
 $nwidth=$width/3;
                    $nheight=$height /3;
                    $nwidth1=$width/2;
                    $nheight1=$height/2;
                    $nwidth2=$width/ 1.5;
                    $nheight2=$height/1.5;
                    $nwidth3= $width/1.2;
                    $nheight3= $height /1.2;
  $newimage=imagecreatetruecolor($nwidth,$nheight);
  $name=explode('.',$imagelink['image1']['name']);
   $file_ext=end($name);
 $currentdate=date("d-m-Y");
      if (!file_exists('../../../../media/'.$currentdate)) {
          mkdir('../../../../media/'.$currentdate, 0777, true);
      }
      $folder_path="../../../../media/$currentdate".'/';			
  //print($folder_path);
  //die();
  $newimage1=imagecreatetruecolor($nwidth1,$nheight1);
  $newimage2=imagecreatetruecolor($nwidth2,$nheight2);
  $newimage3=imagecreatetruecolor($nwidth3,$nheight3);
 
  if($imagelink['image1']['type']=='image/jpeg'){
      $source=imagecreatefromjpeg($imagelink['image1']['tmp_name']);
      imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
      imagecopyresized($newimage1,$source,0,0,0,0,$nwidth1,$nheight1,$width,$height);
      imagecopyresized($newimage2,$source,0,0,0,0,$nwidth2,$nheight2,$width,$height);
      imagecopyresized($newimage3,$source,0,0,0,0,$nwidth3,$nheight3,$width,$height);
     
      $file_name=$name[0].'-'.time().'-200-200'.'.'.$file_ext;
      $file_name1=$name[0].'-'.time().'-400-400'.'.'.$file_ext;
      $file_name_database=$name[0].'-'.time().'.'.$file_ext;
      $file_name2=$name[0].'-'.time().'-800-800'.'.'.$file_ext;
      $file_name3=$name[0].'-'.time().'-600-1400'.'.'.$file_ext;
     
      $file_name=str_replace(' ', '', $file_name);
      $file_name1=str_replace(' ', '', $file_name1);
      $file_name2=str_replace(' ', '', $file_name2);
      $file_name3=str_replace(' ', '', $file_name3);
      
    $original_file=$name[0].'-'.time().'.'.$file_ext;
      $original_file=str_replace(' ','',$original_file);
      $file_name_database=str_replace(' ', '', $file_name_database);
      imagejpeg($newimage,$folder_path.$file_name);
      imagejpeg($newimage1,$folder_path.$file_name1);
      imagejpeg($newimage2,$folder_path.$file_name2);
      imagejpeg($newimage3,$folder_path.$file_name3);
      
    move_uploaded_file($imagelink['image']['tmp_name'],$folder_path.$original_file);
         
   //   imagejpeg($imagelink['image']['name'],'../media/'.$original_file);
      return $file_name_database;
  }elseif($imagelink['image1']['type']=='image/png'){
      $source=imagecreatefrompng($imagelink['image1']['tmp_name']);
      imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
      imagecopyresized($newimage1,$source,0,0,0,0,$nwidth1,$nheight1,$width,$height);
      imagecopyresized($newimage2,$source,0,0,0,0,$nwidth2,$nheight2,$width,$height);
      imagecopyresized($newimage3,$source,0,0,0,0,$nwidth3,$nheight3,$width,$height);
      
      $file_name=$name[0].'-'.time().'-200-200'.'.'.$file_ext;
      $file_name1=$name[0].'-'.time().'-400-400'.'.'.$file_ext;
      $file_name_database=$name[0].'-'.time().'.'.$file_ext;
      $file_name2=$name[0].'-'.time().'-800-800'.'.'.$file_ext;
      $file_name3=$name[0].'-'.time().'-600-1400'.'.'.$file_ext;
        
    
      $original_file=$name[0].'-'.time().'.'.$file_ext;
      //print($file_name);print($file_name1);print($file_name2);
      $file_name=str_replace(' ', '', $file_name);
      $file_name1=str_replace(' ', '', $file_name1);
      $file_name2=str_replace(' ', '', $file_name2);
      $file_name3=str_replace(' ', '', $file_name3);
 
     $original_file=str_replace(' ','',$original_file);
      $file_name_database=str_replace(' ', '', $file_name_database);
      imagepng($newimage,$folder_path.$file_name);
      imagepng($newimage1,$folder_path.$file_name1);
      imagepng($newimage2,$folder_path.$file_name2);
      imagepng($newimage3,$folder_path.$file_name3);
      
    move_uploaded_file($imagelink['image1']['tmp_name'],$folder_path.$original_file);
      
      
    
      return $file_name_database;
  }elseif($imagelink['image1']['type']=='image/gif'){
      $source=imagecreatefromgif($imagelink['image1']['tmp_name']);
      imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
      imagecopyresized($newimage1,$source,0,0,0,0,$nwidth1,$nheight1,$width,$height);
      imagecopyresized($newimage2,$source,0,0,0,0,$nwidth2,$nheight2,$width,$height);
      imagecopyresized($newimage3,$source,0,0,0,0,$nwidth3,$nheight3,$width,$height);
  
      $file_name=$name[0].'-'.time().'-200-200'.'.'.$file_ext;
      $file_name1=$name[0].'-'.time().'-400-400'.'.'.$file_ext;
      $file_name_database=$name[0].'-'.time().'.'.$file_ext;
      $file_name2=$name[0].'-'.time().'-800-800'.'.'.$file_ext;
      $file_name3=$name[0].'-'.time().'-600-1400'.'.'.$file_ext;
        
      $original_file=$name[0].'-'.time().'.'.$file_ext;
      $file_name=str_replace(' ', '', $file_name);
      $file_name1=str_replace(' ', '', $file_name1);
      $file_name2=str_replace(' ', '', $file_name2);
      $file_name3=str_replace(' ', '', $file_name3);
    
    $original_file=str_replace(' ','',$original_file);
      $file_name_database=str_replace(' ', '', $file_name_database);
      imagegif($newimage,$folder_path.$file_name);
   // imagejpeg($imagelink['image']['name'],'../media/'.$original_file);
      imagegif($newimage1,$folder_path.$file_name1);
      imagegif($newimage2,$folder_path.$file_name2);
      imagegif($newimage3,$folder_path.$file_name3);
    
    move_uploaded_file($imagelink['image1']['tmp_name'],$folder_path.$original_file);
      return $file_name_database;
  }else{
      return "false";
  }
}
    public function getMultipleImage($imagelink,$c){
      date_default_timezone_set("Asia/Kolkata");
                        $currentimestamp=date("d-m-Y");
              //echo $currentimestamp;
              //die();
                        $media_path=constant("path");
                        list($width,$height)=getimagesize($imagelink['image']['tmp_name'][$c]);
                      $nwidth=$width/3;
                    $nheight=$height /3;
                    $nwidth1=$width/2;
                    $nheight1=$height/2;
                    $nwidth2=$width/ 1.5;
                    $nheight2=$height/1.5;
                    $nwidth3= $width/1.2;
                    $nheight3= $height /1.2;
                        $newimage=imagecreatetruecolor($nwidth,$nheight);
              			$name=explode('.',$imagelink['image']['name'][$c]);
						$file_ext=end($name);
              //print_r($name[]);
              //print($imagelink['image']['name'][$c]);
              //die();
                        $currentdate=date("d-m-Y");
                        if (!file_exists('../../../../media/'.$currentdate)) {
                          mkdir('../../../../media/'.$currentdate, 0777, true);
                      }
                      $folder_path="../../../../media/$currentdate".'/';
              
                        
                        $newimage1=imagecreatetruecolor($nwidth1,$nheight1);
                        $newimage2=imagecreatetruecolor($nwidth2,$nheight2);
                        $newimage3=imagecreatetruecolor($nwidth3,$nheight3);
                       
      					if($imagelink['image']['type'][$c]=='image/jpeg'){
                            $source=imagecreatefromjpeg($imagelink['image']['tmp_name'][$c]);
                            imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
                            imagecopyresized($newimage1,$source,0,0,0,0,$nwidth1,$nheight1,$width,$height);
                            imagecopyresized($newimage2,$source,0,0,0,0,$nwidth2,$nheight2,$width,$height);
                            imagecopyresized($newimage3,$source,0,0,0,0,$nwidth3,$nheight3,$width,$height);
                          
                            $file_name=$name[0].'-'.time().'-200-200'.'.'.$file_ext;
                            $file_name_database=$name[0].'-'.time().'.'.$file_ext;
                            $file_name1=$name[0].'-'.time().'-400-400'.'.'.$file_ext;
                            $file_name2=$name[0].'-'.time().'-800-800'.'.'.$file_ext;
                            $file_name3=$name[0].'-'.time().'-600-1400'.'.'.$file_ext;
                              
                            $file_name=str_replace(' ', '', $file_name);
                            $file_name1=str_replace(' ', '', $file_name1);
                            $file_name2=str_replace(' ', '', $file_name2);
                            $file_name3=str_replace(' ', '', $file_name3);
                              
                            $file_name_database=str_replace(' ', '', $file_name_database);
                            $original_file=$name[0].'-'.time().'.'.$file_ext;
                          $original_file=str_replace(' ','',$original_file);
                            imagejpeg($newimage,$folder_path.$file_name);
                            imagejpeg($newimage1,$folder_path.$file_name1);
                            imagejpeg($newimage2,$folder_path.$file_name2);
                            imagejpeg($newimage3,$folder_path.$file_name3);
                            
                          move_uploaded_file($imagelink['image']['tmp_name'][$c],$folder_path.$original_file);
                        
                            return $file_name_database;
                        }elseif($imagelink['image']['type'][$c]=='image/png'){
                            $source=imagecreatefrompng($imagelink['image']['tmp_name'][$c]);
                            imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
                            imagecopyresized($newimage1,$source,0,0,0,0,$nwidth1,$nheight1,$width,$height);
                            imagecopyresized($newimage2,$source,0,0,0,0,$nwidth2,$nheight2,$width,$height);
                            imagecopyresized($newimage3,$source,0,0,0,0,$nwidth3,$nheight3,$width,$height);
                         
                            $file_name=$name[0].'-'.time().'-200-200'.'.'.$file_ext;
                            $file_name_database=$name[0].'-'.time().'.'.$file_ext;
                            $file_name1=$name[0].'-'.time().'-400-400'.'.'.$file_ext;
                            $file_name2=$name[0].'-'.time().'-800-800'.'.'.$file_ext;
                            $file_name3=$name[0].'-'.time().'-600-1400'.'.'.$file_ext;
                              
                            $file_name=str_replace(' ', '', $file_name);
                            $file_name1=str_replace(' ', '', $file_name1);
                            $file_name2=str_replace(' ', '', $file_name2);
                            $file_name3=str_replace(' ', '', $file_name3);
                              
                            $file_name_database=str_replace(' ', '', $file_name_database);
                            $original_file=$name[0].'-'.time().'.'.$file_ext;
                          $original_file=str_replace(' ','',$original_file);
                           // print($file_name);print($file_name1);print($file_name2);
                           // die("fg");
                            imagepng($newimage,$folder_path.$file_name);
                            imagepng($newimage1,$folder_path.$file_name1);
                            imagepng($newimage2,$folder_path.$file_name2);
                            imagepng($newimage3,$folder_path.$file_name3);
                            
                          move_uploaded_file($imagelink['image']['tmp_name'][$c],$folder_path.$original_file);                        
                            return $file_name_database;
                        }elseif($imagelink['image']['type'][$c]=='image/gif'){
                            $source=imagecreatefromgif($imagelink['image']['tmp_name'][$c]);
                            imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
                            imagecopyresized($newimage1,$source,0,0,0,0,$nwidth1,$nheight1,$width,$height);
                            imagecopyresized($newimage2,$source,0,0,0,0,$nwidth2,$nheight2,$width,$height);
                            imagecopyresized($newimage3,$source,0,0,0,0,$nwidth3,$nheight3,$width,$height);
                          
                            $file_name=$name[0].'-'.time().'-200-200'.'.'.$file_ext;
                            $file_name1=$name[0].'-'.time().'-400-400'.'.'.$file_ext;
                            $file_name_database=$name[0].'-'.time().'.'.$file_ext;
                            $file_name2=$name[0].'-'.time().'-800-800'.'.'.$file_ext;
                            $file_name3=$name[0].'-'.time().'-600-1400'.'.'.$file_ext;
                              
                            $file_name=str_replace(' ', '', $file_name);
                            $file_name1=str_replace(' ', '', $file_name1);
                            $file_name2=str_replace(' ', '', $file_name2);
                            $file_name3=str_replace(' ', '', $file_name3);
                              
                            $file_name_database=str_replace(' ', '', $file_name_database);
                            $original_file=$name[0].'-'.time().'.'.$file_ext;
                          $original_file=str_replace(' ','',$original_file);
                            imagegif($newimage,$folder_path.$file_name);
                            imagegif($newimage1,$folder_path.$file_name1);
                            imagegif($newimage2,$folder_path.$file_name2);
                            imagegif($newimage3,$folder_path.$file_name3);
                              
                          move_uploaded_file($imagelink['image']['tmp_name'][$c],$folder_path.$original_file);
                        
                            return $file_name_database;
                        }else{
                            return "false";
                        }
    }
 public  function getImage_varient($imagelink){ 
    $currentimestamp=date("d-m-Y");
		$image_details = getimagesize($imagelink);

                    $width= $image_details[0];
                    $height =$image_details[1];
                    $mime_type =$image_details['mime'];
                    
				 $nwidth=$width/3;
                    $nheight=$height /3;
                    $nwidth1=$width/2;
                    $nheight1=$height/2;
                    $nwidth2=$width/ 1.5;
                    $nheight2=$height/1.5;
                    $nwidth3= $width/1.2;
                    $nheight3= $height /1.2;
                    $newimage=imagecreatetruecolor($nwidth,$nheight);
					$pathinfo = pathinfo($imagelink);
                    $name=explode('.',$pathinfo['filename']);
					$file_ext=end(explode('.',$imagelink));
                    $dirname=$pathinfo['dirname'];
                    	
                   $currentdate=date("d-m-Y");
                     
                   $folder_path=$dirname.'/';	
   
                    //print($folder_path);
                    //die();
                    $newimage1=imagecreatetruecolor($nwidth1,$nheight1);
                    $newimage2=imagecreatetruecolor($nwidth2,$nheight2);
    				$newimage3=imagecreatetruecolor($nwidth3,$nheight3);
                    if($mime_type=='image/jpeg'){
                        $source=imagecreatefromjpeg($imagelink);
                        imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
                        imagecopyresized($newimage1,$source,0,0,0,0,$nwidth1,$nheight1,$width,$height);
                        imagecopyresized($newimage2,$source,0,0,0,0,$nwidth2,$nheight2,$width,$height);
                        imagecopyresized($newimage3,$source,0,0,0,0,$nwidth3,$nheight3,$width,$height);
                        
                        $file_name=$name[0].'-200-200'.'.'.$file_ext;
                        $file_name1=$name[0].'-400-400'.'.'.$file_ext;
                        $file_name_database=$name[0].'-'.time().'.'.$file_ext;
                        $file_name2=$name[0].'-800-800'.'.'.$file_ext;
                        $file_name3=$name[0].'-600-1400'.'.'.$file_ext;
                        
                      	$file_name=str_replace(' ', '', $file_name);
                        $file_name1=str_replace(' ', '', $file_name1);
                        $file_name2=str_replace(' ', '', $file_name2);
                        $file_name3=str_replace(' ', '', $file_name3);
                      
                        $original_file=$name[0].'-'.time().'.'.$file_ext;
                        $original_file=str_replace(' ', '', $original_file);
                     //   $original_file=str_replace(' ','',$original_file);
                        $file_name_database=str_replace(' ', '', $file_name_database);
                        imagejpeg($newimage,$folder_path.$file_name);
                        imagejpeg($newimage1,$folder_path.$file_name1);
                        imagejpeg($newimage2,$folder_path.$file_name2);
                        imagejpeg($newimage3,$folder_path.$file_name3);
                     
                     // move_uploaded_file($imagelink['image']['tmp_name'],$folder_path.$original_file);
                           
                     //   imagejpeg($imagelink['image']['name'],'../media/'.$original_file);
                        return $file_name_database;
                    }elseif($mime_type=='image/png'){
                        $source=imagecreatefrompng($imagelink);
                        imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
                        imagecopyresized($newimage1,$source,0,0,0,0,$nwidth1,$nheight1,$width,$height);
                        imagecopyresized($newimage2,$source,0,0,0,0,$nwidth2,$nheight2,$width,$height);
                        imagecopyresized($newimage3,$source,0,0,0,0,$nwidth3,$nheight3,$width,$height);
                         
                        $file_name=$name[0].'-200-200'.'.'.$file_ext;
                        $file_name1=$name[0].'-400-400'.'.'.$file_ext;
                        $file_name_database=$name[0].'-'.time().'.'.$file_ext;
                        $file_name2=$name[0].'-800-800'.'.'.$file_ext;
                        $file_name3=$name[0].'-600-1400'.'.'.$file_ext;
                        
                        $original_file=$name[0].'-'.time().'.'.$file_ext;
                      $original_file=str_replace(' ', '', $original_file);
                        //print($file_name);print($file_name1);print($file_name2);
                        $file_name=str_replace(' ', '', $file_name);
                        $file_name1=str_replace(' ', '', $file_name1);
                        $file_name2=str_replace(' ', '', $file_name2);
                        $file_name3=str_replace(' ', '', $file_name3);
                      
                    //  $original_file=str_replace(' ','',$original_file);
                        $file_name_database=str_replace(' ', '', $file_name_database);
                        imagepng($newimage,$folder_path.$file_name);
                        imagepng($newimage1,$folder_path.$file_name1);
                        imagepng($newimage2,$folder_path.$file_name2);
                        imagepng($newimage3,$folder_path.$file_name3);
                     
                       // move_uploaded_file($imagelink['image']['tmp_name'],$folder_path.$original_file);
                        
                        
                      
                        return $file_name_database;
                    }elseif($mime_type=='image/gif'){
                        $source=imagecreatefromgif($imagelink);
                        imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
                        imagecopyresized($newimage1,$source,0,0,0,0,$nwidth1,$nheight1,$width,$height);
                        imagecopyresized($newimage2,$source,0,0,0,0,$nwidth2,$nheight2,$width,$height);
                        imagecopyresized($newimage3,$source,0,0,0,0,$nwidth3,$nheight3,$width,$height);
                         
                        $file_name=$name[0].'-200-200'.'.'.$file_ext;
                        $file_name1=$name[0].'-400-400'.'.'.$file_ext;
                        $file_name_database=$name[0].'-'.time().'.'.$file_ext;
                        $file_name2=$name[0].'-800-800'.'.'.$file_ext;
                        $file_name3=$name[0].'-600-1400'.'.'.$file_ext;
                          
                        $original_file=$name[0].'-'.time().'.'.$file_ext;
                        $file_name=str_replace(' ', '', $file_name);
                        $file_name1=str_replace(' ', '', $file_name1);
                        $file_name2=str_replace(' ', '', $file_name2);
                        $file_name3=str_replace(' ', '', $file_name3);
                      
                      $original_file=str_replace(' ', '', $original_file);
                      //$original_file=str_replace(' ','',$original_file);
                        $file_name_database=str_replace(' ', '', $file_name_database);
                        imagegif($newimage,$folder_path.$file_name);
                     // imagejpeg($imagelink['image']['name'],'../media/'.$original_file);
                        imagegif($newimage1,$folder_path.$file_name1);
                        imagegif($newimage2,$folder_path.$file_name2);
                        imagegif($newimage3,$folder_path.$file_name3);
                      
                     // move_uploaded_file($imagelink['image']['tmp_name'],$folder_path.$original_file);
                        return $file_name_database;
                    }else{
                        return "false";
                    }
}
}
?>