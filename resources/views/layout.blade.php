
<div class="container" id="commentary">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4>Add comment</h4>

                        <div class="form-group">
                            <textarea class="form-control" name="body"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="button" v-on:click="addComment" v-bind:disabled="isDisabled" class="btn btn-success" value="Add Comment" />
                        </div>
                        <hr />

                        <h4>Display Comments</h4>

                        <div v-for="comment in comments">
                            <strong>@{{ 'User Name' }}</strong>
                            <p>@{{ comment.body }}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Add Vue Code -->
<script>
    var commentary = new Vue({
        el: '#commentary',
        data: {
            socketId: null,
            isDisabled: false,
            comments: [
                { body: 'Learn JavaScript' },
                { body: 'Learn Vue' },
                { body: 'Build something awesome' }
            ]
        },
        methods: {
            addComment(event) {
                event.preventDefault();
                this.isDisabled = true;
                console.log(window.location.pathname);
                let data = {
                    text: document.getElementById("#body") ,
                };
                let token = document.head.querySelector('meta[name="csrf-token"]');
                fetch('{{ route('commentary.add') }}', {
                    body: JSON.stringify(data),
                    credentials: 'same-origin',
                    headers: {
                        'content-type': 'application/json',
                        'x-csrf-token': token.content,
                        'x-socket-id': window.socketId
                    },
                    method: 'POST',
                    mode: 'cors',
                }).then(response => {
                    this.isDisabled = true;
                    if (response.ok) {
                        this.fetchComments();
                        this.showAlert('Comment posted!');
                    }
                })
            },
            fetchComments() {
            },
            subscribe() {
                var socket = new Pusher('{{ env('PUSHER_APP_KEY')}}', {
                    cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
                });
                // set the socket ID when we connect
                socket.connection.bind('connected', function() {
                    this.socketId = socket.connection.socket_id;
                });

                socket.subscribe('comments')
                    .bind('new-comment',this.fetchComments);
            }
        },
        created() {
            this.fetchComments();
            this.subscribe();
        }
    });
</script>
