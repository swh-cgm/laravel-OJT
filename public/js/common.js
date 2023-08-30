$('#CommentForm').on('submit', function (e) {
    e.preventDefault();

    let userComment = $('#user_comment').val();
    let postId = $('#post_id').val();
    let userId = $('#user_id').val();
    let baseUrl = "/laravel-OJT/public/"
    $.ajax({
        url: baseUrl + "posts/" + postId + "/comments/" + userId,
        type: "POST",
        data: {
            "_token": $('[name="_token"]').val(),
            user_comment: userComment,
        },
        success: function (response) {
            $('#user_comment').val('');
            responseJson = JSON.parse(response);
            comment = responseJson.comment.comment;
            commentId = responseJson.comment.id;
            userId = responseJson.comment.user_id;
            userName = responseJson.user;

            $('#comment_container').append(`
            <div class="comment-wrap">
            <a class="comment-user" href="${baseUrl}users/detail/${userId}">${userName}<a> 
            <a class="edit-comment comment-inner" rel="edit" id="edit-comment-id_${commentId}">Edit</a> 
            <a class="text-danger" href="${baseUrl}comments/delete/${commentId}" rel="delete">Delete</a>
            <div class="comment-text comment-inner" id="text-comment-id_${commentId}">${comment}</div>`);

            $('#commentErrorMessage').hide();
        },
        error: function (response) {
            commentErrorMessage = response.responseJSON.errors.user_comment[0];
            $('#commentErrorMessage').text(commentErrorMessage);
        }
    });
});


$(document).on("click", "a.comment-inner",
    function () {
        var id = $(this).attr('id');
        var commentId = id.split("_")[1];

        cmtTxtSelector = "#text-comment-id_" + commentId;
        cmtTxt = $(cmtTxtSelector).text();

        let editPrompt = prompt("Edit Comment", cmtTxt);
        let newComment;
        if (editPrompt == null || editPrompt == "") {
            newComment = cmtTxt;
        } else {
            newComment = editPrompt;
            $.ajax({
                url: "/laravel-OJT/public/comments/update/" + commentId,
                type: "POST",
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    user_comment: newComment
                },
                success: function (response) {
                    $(cmtTxtSelector).text(response);
                },
                error: function (response) {
                }
            });
        }
    });
