<template>
    <div class="container">
        <h4>Add Comment</h4>
        <form action="" @submit.prevent="edit ? editComment(comment.id) : createComment(comment.id ? comment.id : 0)">
            <div class="input-group">
                <textarea name="body" cols="90" rows="3" v-model="comment.text" ref="textarea" class="form-control"></textarea>
            </div>
            <div class="input-group">
                <button type="submit" class="btn btn-primary" v-show="!edit">Add Comment</button>
                <button type="submit" class="btn btn-primary" v-show="edit">Edit Comment</button>
            </div>
        </form>
        <h4>Comments</h4>
        <ul class="list-group">
            <li class="list-group-item" v-for="comment in comments">
                * <span v-for="index in comment.level"> * </span>
                {{comment.text}}
                [<a class="btn btn-default" v-on:click=" createComment(comment.id)">Add here</a> |
                <a class="btn btn-default" v-on:click=" showComment(comment.id)">Edit</a> |
                <a class="btn btn-danger" v-on:click=" deleteComment(comment.id)">Delete</a>]
            </li>
        </ul>
    </div>
</template>

<script>
    export default{
        data: function () {
            return {
                edit: false,
                comments: [],
                comment: {
                    id: '',
                    parent_id: '',
                    text: '',
                    level: '',
                },
            }
        },

        created: function () {
            this.fetchComments();
        },
        ready: function () {
            this.fetchComments();
        },

        methods: {
            fetchComments: function () {
                axios.post("/comments")
                    .then(response => {
                        this.comments = response.data;
                    });
            },

            createComment: function (parent_id = 0) {
                this.comment.parent_id = parent_id;
                axios.post("/comments/store", this.comment)
                    .then(response => {
                        this.comment.text = '';
                        this.fetchComments();
                    });
            },

            editComment: function (comment_id) {
                axios.post("/comments/" + comment_id + "/update", this.comment)
                    .then(response => {
                        this.comment.id = '';
                        this.comment.text = '';
                        this.comment.level = '';
                        this.fetchComments();
                        this.edit = false;
                    });
            },

            deleteComment: function (comment_id) {
                axios.post("/comments/" + comment_id + "/delete")
                    .then(response => {
                        this.comment.text = '';
                        this.fetchComments();
                    });
            },

            showComment: function (comment_id) {
                for (var i = 0; i < this.comments.length; i++) {
                    if (this.comments[i].id == comment_id) {
                        this.comment.id = this.comments[i].id;
                        this.comment.text = this.comments[i].text;
                        this.comment.level = this.comments[i].level;

                        this.edit = true;
                    }
                }
            }
        }
    }
</script>