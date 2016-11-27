Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');

const post = new Vue({
    el: '#vuejs-post',
    data: {
        items: [],
        pagination: {
            total: 0,
            per_page: 2,
            current_page: 1,
            from: 1,
            to: 0
        },
        offset: 4,
        formErrors: {},
        formErrorsUpdate: {},

        newPost: {
            title: '',
            summary: '',
            content: ''
        },

        fillPost: {
            id: '',
            title: '',
            summary: '',
            content: ''
        }
    },
    computed: {
        isActived: function() {
            return this.pagination.current_page;
        },
        pagesNumber: function() {
            if (!this.pagination.to) {
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            var to = from + (this.offset * 2);
            if (from < 1) {
                from = 1;
            }
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },
    mounted: function() {
        console.log('VueJs is ready');
        this.getVueItems(this.pagination.current_page);
    },
    methods: {
        getVueItems: function(page) {
            this.$http.get('/posts?page=' + page).then(
                (response) => {
                    this.items = response.data.data;
                    this.pagination = response.data.pagination;
                }
            );
        },
        newItem: function() {
            $('#create-item').modal('show');
        },
        createItem: function() {
            var input = this.newPost;
            this.$http.post('/posts', input).then(
                (response) => {
                    this.changePage(this.pagination.current_page);
                    this.newPost = {
                        title: '',
                        summary: '',
                        content: ''
                    };
                    $('#create-item').modal('hide');
                    this.alert('Post created success', 'Success Alert');
                },
                (response) => {
                    this.formErrors = response.data;
                }
            );
        },
        editItem: function(item) {
            this.fillPost.id = item.id;
            this.fillPost.title = item.title;
            this.fillPost.summary = item.summary;
            this.fillPost.content = item.content;
            $('#edit-item').modal('show');
        },
        updateItem: function(item) {
            var input = this.fillPost;
            this.$http.put('/posts/' + item.id, input).then(
                (response) => {
                    this.changePage(this.pagination.current_page);
                    this.fillPost = {
                        id: '',
                        title: '',
                        summary: '',
                        content: ''
                    };
                    $('#edit-item').modal('hide');
                    this.alert('Post updated success', 'Success Alert');
                },
                (response) => {
                    this.formErrorsUpdate = response.data;
                }
            );
        },
        removeItem: function(item) {
            this.fillPost = item;
            $('#remove-item').modal('show');
        },
        deleteItem: function(item) {
            this.$http.delete('/posts/' + item.id).then(
                (response) => {
                    this.changePage(this.pagination.current_page);
                    this.fillPost = {
                        id: '',
                        title: '',
                        summary: '',
                        content: ''
                    };
                    $('#remove-item').modal('hide');
                    this.alert('Post deleted success', 'Success Alert');
                }
            );
        },
        changePage: function(page) {
            this.pagination.current_page = page;
            this.getVueItems(page);
        },
        alert: function(message, title) {
            // toastr.success('Post updated success', 'Success Alert', {timeOut: 5000});
            if (title != null) {
                alert(title + ' ' + message);
            } else {
                alert(message);
            }
        }
    }
});
