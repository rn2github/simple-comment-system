<?php $comments = $vars['comments']; $css = $vars['css']; $error = $vars['error']; ?>
<!DOCTYPE html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>

var formHasChanged = false;
var submitted = false;

$(document).ready(function() {

    // Add comment form at the top of the page
    $('body').prepend(getForm('<?=$comments->id?>'));

    // -----------------------------------
    // Requirement
    // -----------------------------------
    //
    // Set the event to block refresh 
    window.onbeforeunload = function (e) {
        if (formHasChanged && !submitted) {
            var message = "You have not saved your changes.", e = e || window.event;
            if (e) {
                e.returnValue = message;
            }
            return message;
        }
    }

    setFormEvent();
});

// -----------------------------------
// Requirement
// -----------------------------------
//
// Set form to block refresh
function setFormEvent(){

    $(document).on('input', 'form input, form textarea', function (e) {
        formHasChanged = true;
    });

    $("form").submit(function(e) {
        submitted = true;
    });
}

// Create and return form to post comment
function getForm(id){
   return " <form method=POST action='?path=postComment'> \
      <input type=hidden name='parentId' value='" + id + "' /> \
      <label for='name'> \
      Name: \
      </label> \
      <input class='name' name='name' id='name' type=text /> \
      <label for='comment'>Comment: </label> \
      <textarea class='comment' name='content' id='comment'></textarea> \
      <input type=submit value='submit' /> \
    </form> \
   ";
}


// Show comment form for reply
function toggleComment(id){
   
   var form = $('#' + id).find('form');

   if(form.length){
       $(form).remove();   
       return;
   }

   $('#reply-button-' + id).after(getForm(id));
   setFormEvent();
}
</script>

<style><?=$css?></style>
</head>
<body>

<?php

/**
 * Helper function to display all comments in the data structure
 */
function comments($comments, $depth){

    foreach($comments as $comment){ ?>
        <div id="<?=$comment->id?>" class="comment-body-wrap" style="padding-left: <?=($depth*10)?>px">
          <div>
            <div class="comment-name"><span style='font-weight: 600'>Author: </span> <?=trim($comment->name) ?></div>
            <div class="comment-timestamp"><?=date('Y-m-d H:i:s', $comment->timestamp) ?></div>
          </div>
          <div class="comment-content">
            <?=$comment->content ?>
          </div>

        <?php
        // -----------------------------------
        // Requirement
        //------------------------------------
        //
        // Maximum of 3 levels in nested comments
        ?>
        <?php if(2 > $depth){ ?>
          <div class="comment-reply-wrap" id="reply-button-<?=$comment->id?>">
            <a class="comment-reply" href="javascript:void(0)" onClick="toggleComment('<?=$comment->id?>')" >reply</a>
          </div>
        <?php } ?>

        <?php if(count($comment->children) > 0){
            // Get and display children's comments
            comments($comment->children, $depth+1);
        }?>

        </div>
<?php }} ?>

<?php if(strlen($error) > 0){ ?>
<h2 style='color: red;'>Error: <?=$error?></h2>
<?php } ?>

<h2>Comments</h2>

<?php if(0 >= count($comments->children)) { ?>
  <h5>No Comments yet</h5>
<?php }else{

// Call helper function to display all comments
comments($comments->children, 0); 
} ?>

</body>
</html>

