
<div id="commentary">
    <ol>
        <li v-for="todo in todos">
            {{ todo.text }}
        </li>
    </ol>
</div>

<!-- Add Vue Code -->
<script>
    var commentary = new Vue({
        el: '#commentary',
        data: {
            todos: [
                { text: 'Learn JavaScript' },
                { text: 'Learn Vue' },
                { text: 'Build something awesome' }
            ]
        },
        methods: {
            displayComment(data) {
                let $comment = $('<div>').text(data['text']).prepend($('<small>').html(data['username'] + "<br>"));
                $('#comments').prepend($comment);
            },
            addComment(event) {
                function showAlert(message) {
                    let $alert = $('#alert');
                    $alert.text(message).show();
                    setTimeout(() => $alert.hide(), 4000);
                }

                event.preventDefault();
                $('#addCommentBtn').attr('disabled', 'disabled');
                let data = {
                    text: $('#text').val(),
                    username: $('#username').val(),
                };
                fetch('/comments', {
                    body: JSON.stringify(data),
                    credentials: 'same-origin',
                    headers: {
                        'content-type': 'application/json',
                        'x-csrf-token': $('meta[name="csrf-token"]').attr('content'),
                        'x-socket-id': window.socketId
                    },
                    method: 'POST',
                    mode: 'cors',
                }).then(response => {
                    $('#addCommentBtn').removeAttr('disabled');
                    if (response.ok) {
                        displayComment(data);
                        showAlert('Comment posted!');
                    } else {
                        showAlert('Your comment was not approved for posting. Please be nicer :)');
                    }
                })
            }
        },
    });
</script>
