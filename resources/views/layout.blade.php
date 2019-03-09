
@php
 $path = Request::path();
@endphp
<div class="container" id="commentary">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4>Add comment</h4>

                        <div class="form-group">
                            <input type="text" v-model="username" class="form-control col-4" placeholder="Enter your username">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" v-model="text" placeholder="Enter your comment"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="button" v-on:click="addComment" v-bind:disabled="isDisabled" class="btn btn-success" value="Add Comment" />
                        </div>
                        <hr />

                        <h4>Display Comments</h4>

                        <div v-for="comment in comments">
                            <strong>@{{ comment.username }}</strong>
                            <p>@{{ comment.text }}</p>
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
            username: null,
            text: null,
            path: window.location.pathname,
            isDisabled: false,
            comments: []
        },
        methods: {
            subscribe() {
                var pusher = new Pusher('{{ env('PUSHER_APP_KEY')}}', {
                    cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
                });
                pusher.subscribe(this.path)
                    .bind('new-comment', this.fetchComments);
            },
            fetchComments() {
                var vm = this;
                fetch('{{ route('commentary.index') . '?' . 'path=' . $path }}')
                .then(function(response) {
                    return response.json()
                })
                .then(function(json) {
                    vm.comments = json
                })
            },
            addComment(event) {
                event.preventDefault();
                this.isDisabled = true;
                console.log(this.path);
                let data = {
                    path: this.path,
                    text: this.text,
                    username: this.username,
                };
                let token = document.head.querySelector('meta[name="csrf-token"]');
                fetch('{{ route('commentary.store') }}', {
                    body: JSON.stringify(data),
                    credentials: 'same-origin',
                    headers: {
                        'content-type': 'application/json',
                        'x-csrf-token': token.content,
                        'x-socket-id': this.socketId
                    },
                    method: 'POST',
                    mode: 'cors',
                }).then(response => {
                    this.isDisabled = false;
                    if (response.ok) {
                        this.username = '';
                        this.text = '';
                        this.fetchComments();
                    }
                })
            },
        },
        created() {
            this.subscribe();
            this.fetchComments();
        }
    });
</script>
