<?php
require_once("DatabaseAccess.php");


function getPostsFromDb(){
    // execute query and get cards data from the Posts table in the database
	 return getDbAccess()->executeQuery("SELECT * FROM Posts;");
}

function getCommentsFromDb($id){
    // execute query and get cards data from the Posts table in the database
	 return getDbAccess()->executeQuery("SELECT * FROM Comments WHERE PostID='$id';");
}

// generate html code for cards using data from the database
function generatePostsHtml(){
    $html = "";

    $cards = getPostsFromDb();

    foreach($cards as $card){
        // get values of the columns in the table in order 
        $id = $card[0];
        $username = $card[1];
        $imageUrl = $card[2];
        $description = $card[3];
        $liked = $card[4];
        $likes = $card[5];
        $bookmarked = $card[6];
        $bookmarks = $card[7];

        $comments = getCommentsFromDb($id);
        
        $commentsList = "";
        foreach($comments as $comment)
        {
            $user = $comment[1];
            $text = $comment[2];
            $commentsList .= "<div class='user-comment'> <p><b>$user</b>: $text</p> </div>";
        }
        $heartClass = $liked == '1' ? "fa-heart" : "fa-heart-o";
        $bookmarkClass = $bookmarked == '1' ? "fa-bookmark" : "fa-bookmark-o";
     
        $html = "<div class='users-post'  data-post-id='$id'>
                    <div class='posted-image'>
                        <img src='$imageUrl' alt=''>
                    </div>  
                    <div class='user-comment post-description'>
                        <p>$description</p>
                    </div>
                    <div class='post-actions-container'>
                        <div class='user-img'>
                            <img src='$imageUrl' alt='$id'>
                        </div>
                        <div class='posts-stats'>
                            <div class='posts-user-name'>
                                <h2>$username</h2>
                            </div>
                            <div class='posts-time-added'>
                                <p>45 min ago</p>
                            </div>
                        </div>
                        <div class='posts-reactions'>
                            <div class='like-reaction'>
                                <i class='heart-icon fa $heartClass fa-2x'></i>
                                <p>Likes($likes)</p>
                            </div>
                            <div class='bookmark-reaction'>
                                <i class='bookmark-icon fa $bookmarkClass fa-2x'></i>
                                <p>Bookmarks($bookmarks)</p>
                            </div>
                        </div> 
                    </div>
                    <div class='comment-num-and-add'>
                        <textarea name='' id='' cols='25' rows='3' placeholder='Add comment'></textarea>
                        <button>Add comment</button>
                    </div>
                    $commentsList
                </div>".$html;
    }

    return $html;
}

function togglePostLike($id, $liked, $likes){
    getDbAccess()->executeQuery("UPDATE Posts SET Liked='$liked', Likes='$likes' WHERE ID='$id'");
}

function togglePostBookmark($id, $bookmarked, $bookmarks){
    getDbAccess()->executeQuery("UPDATE Posts SET Bookmarked='$bookmarked', Bookmarks='$bookmarks' WHERE ID='$id'");
}

function addPost($username, $imageUrl, $description)
{
    getDbAccess()->executeInsertQuery("INSERT INTO Posts values ('0', '$username', '$imageUrl', '$description', '0', '0', '0', '0')");
}

function addComment($username, $text, $postid)
{
    getDbAccess()->executeInsertQuery("INSERT INTO Comments values ('0', '$username', '$text', '$postid')");
}

