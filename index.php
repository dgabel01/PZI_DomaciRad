  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>PZI Domaci Rad</title>
    <link rel="icon" type="image/x-icon" href="images/logo/socialclone-high-resolution-color-logo.png">
    <template id='post-template'>
                  <div class='users-post'  data-post-id='$id'>
                    <div class='posted-image'>
                        <img src='' alt=''>
                    </div>  
                    <div class='user-comment post-description'>
                        <p></p>
                    </div>
                    <div class='post-actions-container'>
                        <div class='user-img'>
                            <img src='' alt=''>
                        </div>
                        <div class='posts-stats'>
                            <div class='posts-user-name'>
                                <h2></h2>
                            </div>
                            <div class='posts-time-added'>
                                <p>45 min ago</p>
                            </div>
                        </div>
                        <div class='posts-reactions'>
                            <div class='like-reaction'>
                                <i class='heart-icon fa  fa-heart-o fa-2x'></i>
                                <p>Likes(0)</p>
                            </div>
                            <div class='bookmark-reaction'>
                                <i class='bookmark-icon fa fa-bookmark-o fa-2x'></i>
                                <p>Bookmarks(0)</p>
                            </div>
                        </div> 
                    </div>
                    <div class='comment-num-and-add'>
                        <textarea name='' id='' cols='25' rows='3' placeholder='Add comment'></textarea>
                        <button>Add comment</button>
                    </div>
                </div>
    </template>
    <template id='comment-template'>
        <div class='user-comment'>
          <p><b></b></p>
        </div>
    </template>
  </head>
  <body>
    <div class="top-container">
            <a href="index.html" target="_blank"><img src="images/logo/socialclone-high-resolution-color-logo.png" alt=""></a>
            <div class="search-container">
                <input type="text" placeholder="Search...">
                <button><i class="fa fa-search search-icon"></i></button>
            </div>
            <div class="icons-container">
                    <p id ="greetings-text">Hi, User!</p>
                    <a href="#top"><img id="img1" src="images/top_icons/vecteezy_house-and-home-icon-symbol-sign_10157862_314.png" alt=""></a>
                    <img id="img2" src="images/top_icons/vecteezy_email-icon-black_16586174_914.png" alt="">
                    <img id="img3" src="images/top_icons/vecteezy_bell-icon-png-transparent-notification-png_9394759_794.png" alt="">
                    <img id="img4"  src="images/top_icons/vecteezy_people-icon-sign-symbol-design_10159990_788.png" alt="">
                    <img id="img5"  src="images/top_icons/vecteezy_transparent-configuration-gear-icon_16314416_717.png" alt="">
                    <img id="img6"  src="images/top_icons/220-2203495_exit-exit-icon-color-hd-png-download.png" alt="">
          </div>
    </div>
    <main>
        <div class="columns">
          <div class="column1">
            <div class="user-profile-pic">
               <img src="images/user_profile_pic/ER8VfeSQDCwyhy4VonxycZ.jpeg" alt="">
            </div>
            <div class="user-profile-stats">
                  <h1>User</h1>
                  <p>Posts : <span id ="right-posts-number">2</span></p>
                  <p>Likes : <span id ="right-likes-number">4</span></p>
                  <p>Joined : 7.9.2009</p>
                  <p>Friends : 232142</p>
           </div>  
          </div>
          <div class="column2">
                <div class="new-post">
                  <div class="new-post-inputs">
                    <textarea name="new-post-text" id="new-post-text" cols="90" rows="3" placeholder="Thoughts?"></textarea>
                    <input type="text" name="new-post-image" id="new-post-image" placeholder="Image URL"></input>
                  </div>
                  <button id ="new-post-button">POST</button>
                </div>
                <div class="posts">
                <?php 
                  require_once("posts.php");
                  echo(generatePostsHtml());
                ?>
                </div>
          </div>
      </div>
    </main>
  </body>
  <footer>
    <a href="https://github.com/dgabel01/PZI_DomaciRad" target="blank"><p>PZI DOMAĆI RAD 2023</p></a>
  </footer>
  <script src="scripts/script.js"></script>
</html>