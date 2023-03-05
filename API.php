<?php
require_once("posts.php");

function processRequest(){
  $action = getRequestParameter("action");

    switch ($action) {
      case 'togglePostLike':
        processTogglePostLike();
        break;
      case 'addPost':
        processAddPost();
        break;
      case 'addComment':
        processAddComment();
        break;
      case 'togglePostBookmark':
        processTogglePostBookmark();
        break;
      default:
      echo(json_encode(array(
         "success" => false,
         "reason" => "Unknown action: $action"
      )));
      break;
    }
}

// getRequestParameter("action") -> "deletePost"
function getRequestParameter($key) {
   // $_REQUEST[$key] -> a map of keys and values from the request
   return isset($_REQUEST[$key]) ? $_REQUEST[$key] : "";
}

function processTogglePostLike(){
  $success = false;
  $reason = "";

  $id = getRequestParameter("id");
  $liked = getRequestParameter("liked");
  $likes = getRequestParameter("likes");

  if (is_numeric($id) && is_numeric($liked) && is_numeric($likes)) {
    togglePostLike($id, $liked, $likes);
    $success = true;
  } 
  else {
    $success = false;
    $reason = "Needs id:number; liked:number; likes:number";
  }

  echo(json_encode(array(
  "success" => $success,
  "reason" => $reason
  )));
}


function processTogglePostBookmark(){
  $success = false;
  $reason = "";

  $id = getRequestParameter("id");
  $bookmarked = getRequestParameter("bookmarked");
  $bookmarks = getRequestParameter("bookmarks");

  if (is_numeric($id) && is_numeric($bookmarked) && is_numeric($bookmarks)) {
    togglePostBookmark($id, $bookmarked, $bookmarks);
    $success = true;
  } 
  else {
    $success = false;
    $reason = "Needs id:number; bookmarked:number; bookmarks:number";
  }

  echo(json_encode(array(
  "success" => $success,
  "reason" => $reason
  )));
}

function processAddPost()
{
  $success = false;
  $reason = "";
  $id = 0;
  $username = getRequestParameter('username');
  $imageUrl = getRequestParameter('imageUrl');
  $description = getRequestParameter('description');
  if($username != "" && $imageUrl != "" && $description != "")
  {
    $id = addPost($username, $imageUrl, $description);
    $success = true;
  }
  else
  {
    $success = false;
    $reason = "username, imageUrl and description need to be non empty strings";
  }
  echo(json_encode(array(
    "success" => $success,
    "reason" => $reason,
    "id" => $id
    )));
}

function processAddComment()
{
  $success = false;
  $reason = "";
  $id = 0;
  $username = getRequestParameter('username');
  $text = getRequestParameter('text');
  $postid = getRequestParameter('postid');
  if($username != "" && $text != "" && is_numeric($postid))
  {
    $id = addComment($username, $text, $postid);
    $success = true;
  }
  else
  {
    $success = false;
    $reason = "username, text and postid need to be non empty strings";
  }
  echo(json_encode(array(
    "success" => $success,
    "reason" => $reason,
    "id" => $id
    )));
}


processRequest();