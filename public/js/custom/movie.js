$(document).ready(function(){

    let fav_count=$('#nav_fav_count').data('fav-count');
    
    $(document).on('click','.movie_fav-icon',function(){
         let url=$(this).data('url');
         let movieId=$(this).data('movie-id');
         let isfavored=$(this).hasClass('fa-heart');
         if(isfavored)
         {
            fav_count--;
            $('.movie-'+movieId).removeClass('fa-heart');
            $('.movie-'+movieId).addClass('fa-heart-o');   
         }
         else{      
                fav_count++;
              $('.movie-'+movieId).removeClass('fa-heart-o');
              $('.movie-'+movieId).addClass('fa-heart');
         }
         $('#nav_fav_count').html(fav_count);
        
         $.ajax({
             url:url,
             method:'post',
             success:function(){

             }
         });

          
    });
});