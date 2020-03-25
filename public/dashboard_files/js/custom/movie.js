$(document).ready(function(){
     $('#movie_file_input').on('change',function(){
       $('#movie_properties').css('display','block'); 
       $('#movie_upload_wrapper').css('display','none'); 
       var movie=this.files[0];
       var movie_name=movie.name.split('.').slice(0,-1).join('.');
       var movie_id=$(this).data('movie_id');
       var url=$(this).data('url');
       $('#movie_name').val(movie_name);
       var formData=new FormData();
       formData.append('movie_id',movie_id);
       formData.append('name',movie_name);
       formData.append('movie',movie);
       $.ajax({

        url : url,
        data:formData,
        method:'post',
        processData:false,
        contentType:false,
        cache:false,
        success : function(movieBeforeProcessing) {              
            var interval=setInterval(function(){
                $.ajax({
                   url:'/dashboard/movies/'+movieBeforeProcessing.id,
                   method:'get',
                success:function(movieWhileProcessing)
                {
                    $('#movie_upload_status').html('Processing');
                    $('#movie_upload_progess').css("width",movieWhileProcessing.percent+'%');
                    $('#movie_upload_progess').html(movieWhileProcessing.percent+'%');
                          
                    if(movieWhileProcessing.percent==99)
                    {
                        clearInterval(interval);
                        $('#movie_upload_status').html('Done Processing');
                        $('#movie_upload_progess').css("display","none");
                        $('#movie_submit_bt').css("display","block");

                    }
                },

                });//end of ajax call
            },3000)
        },
        xhr:function(){
            var xhr=new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress",function(evt){
                if(evt.lengthComputable)
                {
                    var percentComplete=Math.round(evt.loaded/evt.total *100)+"%";
                     $('#movie_upload_progess').css("width",percentComplete).html(percentComplete);
                }
            },false);
            return xhr;
            
        }
    });
       

     });
});