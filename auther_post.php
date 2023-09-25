
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
                if(isset($_GET['p_id'])){

                    $the_post_id=$_GET['p_id'];

                }

                $query="SELECT * FROM post WHERE post_id=$the_post_id ";
                $select_all_post=mysqli_query($connection,$query);

                while($row=mysqli_fetch_assoc($select_all_post)){


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



              <?php  }  ?>


              <!-- Blog Comments -->

                    <?php

                    if(isset($_POST['creat_comment'])){


                        
                        $the_post_id=$_GET['p_id'];

                        $comment_auther=$_POST['comment_auther'];
                        $comment_email=$_POST['comment_email'];
                        $comment_contant=$_POST['comment_contant'];

                        if(!empty($comment_auther) && !empty($comment_email) && !empty($comment_contant)){


                            $query=" INSERT INTO comments(comment_post_id,comment_auther,comment_email,comment_contant,comment_status,comment_data)
                        VALUES ($the_post_id, '{$comment_auther}','{$comment_email}','{$comment_contant}','unapproved',now() )";
                       
                       $creat_comment_query=mysqli_query($connection,$query);

                       if(!$creat_comment_query){
                        die('QUERY FAILED'.mysqli_error($connection));

                       }
                       $query="UPDATE post SET post_comment_count =post_comment_count +1 WHERE post_id =$the_post_id ";
                       $updat_comment_count=mysqli_query($connection,$query);


                    }else{


                        echo"<script>alert('Fieleds connot')</script>";



                    }





                        }






                        

                    ?>


                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                    <div class="from-group">
                    <label for="Auther">Auther</label>
                        <input type="text" class="form-control" name="comment_auther">
                </div>

                <div class="from-group">
                <label for="Email">Email</label>
                        <input type="email" class="form-control" name="comment_email">
                </div>

                        <div class="form-group">
                        <label for="comment">Your Comment </label>
                            <textarea name="comment_contant" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="creat_comment" class="btn btn-primary" >Submit</button>
                    </form>
                </div>

                <hr>

                                        <?php 
                                            
                        $query="SELECT * FROM comments WHERE comment_post_id={$the_post_id} AND comment_status = 'approve' ORDER BY comment_id DESC ";
                        $select_comment_query=mysqli_query($connection,$query);
                        if(!$select_comment_query){

                            die('QUERY Failed'.mysqli_error($connection));

                        }           
                        while($row=mysqli_fetch_array($select_comment_query)){

                            $comment_date=$row['comment_data'];
                            $comment_contant=$row['comment_contant'];
                            $comment_auther=$row['comment_auther'];

                            ?>


 <!-- Comment -->
 <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_auther;?>
                            <small><?php echo $comment_date;  ?></small>
</h4>
<?php echo $comment_contant; ?>
                    </div>
                    
</div>





<?php }  ?>





               
                </div>

  

            </div>

           


          


        </div>
        <!-- /.row -->
       
        <hr>
        

        <!-- Footer -->
       <?php include"include/footer.php"; ?>