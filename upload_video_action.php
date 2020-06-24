<?php
  
  error_reporting(0);
  
  include('upload_connection.php');
  
  if(isset($_FILES['upload_video']['name'])!= ''){
	
	 $name = $_FILES['upload_video']['name'];
	 
	 $tmp_name = $_FILES['upload_video']['tmp_name'];
		  
	 $target_file = "upload_video/".$name;
		  
	 move_uploaded_file($tmp_name, $target_file);
		  
    $thumb = $_POST['thumbnail'];
	
	 $img = str_replace('data:image/png;base64,', '', $thumb);
	
	 $img = str_replace('', '+', $img);
	 
	 $data = base64_decode($img);
	 
	 $imgFile = "upload_thumb/"."$name.png";
	 
	 $success = file_put_contents($imgFile, $data);
	 
	 $thumb_url = "http://localhost/videos/".$imgFile;
	
	 $video_url = "http://localhost/videos/upload_video/".$name;
	
	 $sql = "INSERT INTO `videos`(`video_url`,`thumbnail`) VALUES ('$video_url','$thumb_url')";
		  
	 $result = mysqli_query($conn, $sql);
		  
		  if($result){
			  
			  echo "Insert successfully";
			  
		  }else{
			  
			  echo "error";
		  }
	 
	
	 	  
  }
  
  //fecth thumb
  
  if(isset($_POST['action'])){
	  
	  $sql = "SELECT * FROM `videos` ORDER BY `id` DESC";
		  
      $result = mysqli_query($conn, $sql);
	  
	  while($row = mysqli_fetch_assoc($result)){
		  
		 $images = $row['thumbnail']; 
		 
		 $id = $row['id']; 
		 
		 if( $images == null){
			 
			 $image_url = '<img src="icon/post_image.png" />';
			 
		 }else{
			 
			 $image_url = '<img src="'.$images.'" />';
			 
		 }
		 
		 echo '<div class="upload-display-image" data-video_id="'.$id.'">
  
                  '.$image_url .'
				  
				  <div class="play-icon">
				  
				   <img src="icon/play.png" />
  
				  </div>
				  
               </div> ';
	  }
		   
     
  }
  
  
   // fetch grid modal thumbnails
   
   
    if(isset($_POST['action_fetch_grid_thumb'])){
	   
	    $imageId = $_POST['video_id'];
		
		//first id
		
	   $sql = "SELECT * FROM `videos` ORDER BY `id` ASC LIMIT 1";
	   
	   $result = mysqli_query($conn, $sql);
	   
	   while($row = mysqli_fetch_assoc($result)){
		   
		   $firstId = $row['id'];
		
	   }
	   
	  // last id
	  
	   $sql = "SELECT * FROM `videos` ORDER BY `id` DESC LIMIT 1";
	   
	   $result = mysqli_query($conn, $sql);
	   
	   while($row = mysqli_fetch_assoc($result)){
		   
		   $lastId = $row['id'];
		
	   }
	   
	   // prev id and next id 
	   
	    $sql = "SELECT * FROM `videos` WHERE `id` > '$imageId' ORDER BY `id` LIMIT 1";
	   
	   $result = mysqli_query($conn, $sql);
	   
	   while($row = mysqli_fetch_assoc($result)){
		   
		   $prevId = $row['id'];
		
	   }
	   
	    $sql = "SELECT * FROM `videos` WHERE `id` < '$imageId' ORDER BY `id` DESC LIMIT 1";
	   
	   $result = mysqli_query($conn, $sql);
	   
	   while($row = mysqli_fetch_assoc($result)){
		   
		   $nextId = $row['id'];
		
	   }
		
	   $sql = "SELECT * FROM `videos` WHERE `id`='$imageId' ";
	   
	   $result = mysqli_query($conn, $sql);
	   
	   while($row = mysqli_fetch_assoc($result)){
		   
		    $id = $row['id'];
			
			$imageUrl = $row['video_url'];
			
			if($imageUrl == null){
				
				$image_url = '<a><img src="icon/post_image.png" /></a>';
				
			}else{
				
				$image_url = '<a><video id="video" src="'.$imageUrl.'" autoplay controls/></a>';
				
			}
			
			if($id == $lastId ){
				
			 $prev  = '<div class="modal-image-prev" style="display:none;" data-video_id="'.$prevId.'">
	
	                     <a>&#10094;</a>
		
                       </div>';
				
			}else{
				
				$prev  = '<div class="modal-image-prev" data-video_id="'.$prevId.'">
	
	                       <a>&#10094;</a>
		
                         </div>';
			  
			}
			
			if($id == $firstId ){
				
				$next = '<div class="modal-image-next" style="display:none;" data-video_id="'.$nextId.'">
	
	                       <a>&#10095;</a>
		
                         </div>';
				
			}else{
				
				$next = '<div class="modal-image-next" data-video_id="'.$nextId.'">
	
	                       <a>&#10095;</a>
		
                         </div>';
				
			}
			
			
			echo '<span class="modal-close">&times;</span>
	
	     <div class="modal-container-inside">
	
	         <div class="modal-image">
	
	            '.$image_url.'
		
             </div>
			 
			   '.$prev.'
			    
			   '.$next.'
		
         </div>';
		
	   }
	   
	}
   
   
   
   
   
   
   
  
  
  
  
  
 ?>