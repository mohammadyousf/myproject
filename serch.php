
<?php include"include/db.php"; ?>

<?php include"include/header.php"; ?>

    <!-- Navigation -->
  <?php include"include/nav.php"; ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">




            



                <?php 





 


    if(isset($_POST['submit'])){


       $serch= $_POST['sarch'];

      $query="SELECT * FROM post WHERE post_tags LIKE '%$serch%' ";
      $serch_query=mysqli_query($connection,$query);



      if(!$serch_query){


        die("QUERY FILLED ".mysqli_error($connection));
      }
        $count=mysqli_num_rows( $serch_query);

        if($count==0){
           echo"<h1>NO RESULT</h1>" ;


        }else{
            
            

            while($row=mysqli_fetch_assoc($serch_query)){


               $post_title= $row['post_title'];
               $post_auther = $row['post_auther'];
               $post_date= $row['post_date'];
               $post_image= $row['post_image'];
               $post_content= $row['post_content'];
               $post_tags= $row['post_tags'];
               $post_comment_count = $row['post_comment_count'];
               $post_status= $row['post_status'];

               ?>
                

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
            <h2>
                <a href="#"><?php echo $post_title; ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?php echo $post_auther; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
            <hr>
            <img class="img-responsive" src="imag/<?php echo $post_image; ?>" alt="">
            <hr>
            <p><?php echo $post_content; ?></p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>



          <?php  }  
        }
        
    }


  
?>





                
                
                
            
                
            
                

               

            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php include"include/sidebar.php"; ?>






        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
       <?php include"include/footer.php"; ?>