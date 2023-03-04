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

  if (is_numeric($id) && is_numeric($liked)) {
    togglePostLike($id, $liked);
    $success = true;
  } 
  else {
    $success = false;
    $reason = "Needs id:number; liked:number";
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

  if (is_numeric($id) && is_numeric($bookmarked)) {
    togglePostBookmark($id, $bookmarked);
    $success = true;
  } 
  else {
    $success = false;
    $reason = "Needs id:number; bookmarked:number";
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

processRequest();