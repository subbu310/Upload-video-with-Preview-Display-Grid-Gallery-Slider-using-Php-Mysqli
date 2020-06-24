<!DOCTYPE html>
<html>
<head>

<title>Upload video</title>
 
<meta charset="utf-8">
  
<meta name="viewport" content="width=device-width, initial-scale=1">
 
 <!----add jquery link----> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  
<style>
*{
	
	margin:0;
	padding:0;
	box-sizing:border-box;
}
.container{
	
	width:100%;
	height:100%;
}
.heading-container{
	
	width:100%;
	height:100px;
	text-align:center;
}
h2{
	
	font-size:30px;
	line-height:100px;
	color:blue;
	
}
.upload-container{
	
	width:100%;
	max-width:1000px;
	margin:auto;
	height:200px;
	display:flex;
	align-items:center;
	justify-content:space-between;
}
.upload-left{
	
	width:280px;
	height:200px;
	border:1px solid #ccc;
	display:flex;
	align-items:center;
	justify-content:center;
}
.upload-right{
	
	width:700px;
	height:200px;
	border:1px solid #ccc;
	display:flex;
}
.upload-preview-video{
	
	width:200px;
	height:200px;
	margin-left:10px;
	display:none;
}
.upload-preview-video video{
	
	width:100%;
	height:100%;
	object-fit:fill;
}
.upload-preview-image{
	
	width:200px;
	height:200px;
	margin-left:10px;
	display:none;
}
.upload-preview-image img{
	
	width:100%;
	height:100%;
}
.upload-submit{
	
	width:100%;
	max-width:1000px;
	margin:auto;
	height:100px;
	display:flex;
	align-items:center;
	justify-content:center;
}
.upload-submit button{
	
	width:100px;
	padding:5px;
	color:white;
	background-color:blue;
	font-size:15px;
    cursor:pointer;
}
.upload-display{
	
	width:100%;
	max-width:1000px;
	margin:auto;
	border:1px solid #ccc;
	display:flex;
	flex-wrap:wrap;
}

.upload-display-image{
	
	width:32.5%;
	height:300px;
	margin:0.25%;
	cursor:pointer;
	position:relative;
}
.upload-display-image img{
	
	width:100%;
	height:100%;
}
.play-icon{
	
	width:30px;
	height:30px;
	position:absolute;
	top:50%;
	left:50%;
}
.play-icon img{
	
	width:100%;
	height:100%;
}
@media only screen and (max-width:768px){
	
 .upload-display-image{
	
	height:150px;
	
}
 h2{
	
	font-size:10px;
	
	
 }
}
.modal-container{
	
	display:none;
	width:100%;
	height:100%;
	position:fixed;
	top:0;
	right:0;
	left:0;
	bottom:0;
	background-color:rgba(0,0,0,0.6);
}
.modal-container-inside{
	
	width:100%;
	max-width:1000px;
	margin:auto;
	height:500px;
	background-color:rgba(0,0,0,0.6);
	margin-top:100px;
	position:relative;
}
.modal-image{
	
	width:100%;
	max-width:800px;
	margin:auto;
	height:500px;
	background-color:white;
}
.modal-container-inside video{
	
	width:100%;
	height:100%;
	object-fit:fill;
}
span{
	
	position:absolute;
	top:20px;
	font-size:40px;
	right:30px;
	color:white;
	cursor:pointer;
}
.modal-image-prev{
	
	width:50px;
	height:50px;
	background-color:#ccc;
	position:absolute;
	top:50%;
	border-radius:50%;
	left:50px;
	text-align:center;
	cursor:pointer;
}
.modal-image-next{
	
	width:50px;
	height:50px;
	background-color:#ccc;
	position:absolute;
	top:50%;
	border-radius:50%;
	right:50px;
	text-align:center;
	cursor:pointer;
}
.modal-image-prev, .modal-image-next a{
   
    font-size:20px;
	line-height:50px;
	color:white;
}
</style>

</head>

<body>
  
  <div class="container">
  
      <div class="heading-container">
  
        <h2>Upload video with Preview, Display Grid Gallery Slider using Php Mysqli</h2>
  
       </div>
	   
	   <div class="upload-container">
          
		  <div class="upload-left">
  
             <input type="file" name="file[]" id="upload_file" onchange="preview();" multiple/>
			 
          </div>
	   
	     <div class="upload-right">
		 
		    <div class="upload-preview-video">
  
                  <video id="video-preview" src="" autoplay controls/>
				  
             </div> 
  
             <div class="upload-preview-image" id="image-preview">
  
                  
             </div> 
			   
         </div>

       </div>
	   
	    <div class="upload-submit">
  
                  <button id="submit">submit</button>
				  
        </div>
		
		<div class="upload-display">
  
            
			 
         </div>
		 
	  <div class="modal-container">
	 
	    
		
      </div>
  
  </div>
   
<script>

  $(document).ready(function(){ 
	  
	   var video = $("#video-preview").get(0);
	   
	   var canvas = document.createElement('canvas');
	   
	   var img = document.createElement('img');
	   
	   var context = canvas.getContext('2d');
	   
	   $("#video-preview").on('pause', function(){ 
		   
		    canvas.width = video.videoWidth;
			
			canvas.height = video.videoHeight;
			
			context.drawImage(video,0,0, canvas.width, canvas.height);
			 
			img.src = canvas.toDataURL();
			 
			$("#image-preview").html(img);
			
	   });
	   
	   
	   $('#submit').click(function(){
		   
	     var files = document.getElementById('upload_file').files[0];
		 
		 var thumbnail = canvas.toDataURL();
		 
		 var form_data = new FormData();
		    
			 form_data.append("upload_video", files); 
		     
			 form_data.append("thumbnail", thumbnail); 
			 
			 if(img.src == ''){
				
				alert('select file and thumbnail');
				 
			 }else{
				 
				$.ajax({
				 
			    url:"upload_video_action.php",
                
				method:"post",
				
				data:form_data,
				
				contentType:false,
				
				cache:false,
				
				processData:false,
				
				success:function(data){
					
					//alert(data);
					
					fetch_thumb();
					
					$("#upload_file").val('');
					
					context.clearRect(0,0, canvas.width, canvas.height);
					
					$(".upload-preview-video").hide();
					
					$(".upload-preview-image").hide();
					
					 video.pause();
	  
					
				}
				
			 }); 
			 }
		  
		     
		 
      });
	  
	 // fetch images
	 
	   fetch_thumb();
	   
	   function fetch_thumb()
	   {
		  
		  var action = "fetch_thumb";
		  
		  $.ajax({
				 
			    url:"upload_video_action.php",
                
				method:"post",
				
				data:{action:action},
				
				success:function(data){
					
					$('.upload-display').html(data);
					
				}
				
			 }); 
	   }
	   
	   
	     //thumbnail  click
	   
	 $(document).on('click','.upload-display-image', function (){
		 
		 var video_id = $(this).data('video_id');
		 
		 $('.modal-container').css({'display':'block'});
		 
		 fetch_grid_videos(video_id);
		 
	 });

       //modal close
	   
	 $(document).on('click','.modal-close', function (){
		  
		 $('.modal-container').css({'display':'none'});
		 
		 var videos = document.getElementById('video');
		 
		  videos.pause();
	  
		  
	 });	 
		 

     //modal next images click
	   
	 $(document).on('click','.modal-image-next', function (){
		 
		 var video_id = $(this).data('video_id');
		  
		 fetch_grid_videos(video_id);
		 
	 });
	 
	 //modal prev images click
	   
	 $(document).on('click','.modal-image-prev', function (){
		 
		 var video_id = $(this).data('video_id');
		  
		 fetch_grid_videos(video_id);
		 
	 });
		 
	   //fetch grid modal images
	     
		
	   function fetch_grid_videos(video_id)
	   {
		  
        var action = 'fetch_grid_videos';

        $.ajax({
		 
          url:"upload_video_action.php",
          
          method:"post",
          
          data:{action_fetch_grid_thumb:action, video_id:video_id},
		  
		  success: function(data){
			  
			  $('.modal-container').html(data);
			  
		  }	
		  
		});		
		   
	   }  
	   
	   
	  
	  
  });

   function preview(){
	   
	
	$("#video-preview").attr("src", URL.createObjectURL(event.target.files[0]));
		
	$(".upload-preview-video").show();
	
    $(".upload-preview-image").show();
 	 
   }
   
</script>

</body>
</html>