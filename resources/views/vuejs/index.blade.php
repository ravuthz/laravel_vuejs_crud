@extends('layouts.app')

@section('content')
    <div class="container" id="vuejs-post">

        {{-- Create Modal --}}
        <div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="post" enctype="multipart/form-data" v-on:submit.prevent="createItem">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                            <h4 class="modal-title" id="modal-label">
                                Create New Post
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input name="title" class="form-control" type="text" v-model="newPost.title">
                                <span v-if="formErrors['title']" class="error text-danger">
                                    @{{ formErrors['title'] }}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="summary">Summary</label>
                                <textarea name="summary" class="form-control" v-model="newPost.summary"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea name="content" class="form-control" v-model="newPost.content"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-block btn-sm btn-success">Create Post Now</button>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn btn-block btn-sm btn-default" data-dismiss="modal" aria-label="Close">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        {{-- End Create Modal --}}

        {{-- Update Modal --}}
        <div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="post" enctype="multipart/form-data" v-on:submit.prevent="updateItem(fillItem)">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                            <h4 class="modal-title" id="modal-label">
                                Modify Exists Post
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input name="title" class="form-control" type="text" v-model="fillPost.title">
                                <span v-if="formErrorsUpdate['title']" class="error text-danger">
                                    @{{ formErrorsUpdate['title'] }}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="summary">Summary</label>
                                <textarea name="summary" class="form-control" v-model="fillPost.summary">

                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea name="content" class="form-control" v-model="fillPost.content">

                                </textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-block btn-sm btn-success">Save Post Now</button>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn btn-block btn-sm btn-default" data-dismiss="modal" aria-label="Close">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        {{-- End Update Modal --}}

        {{-- Delete Modal --}}
        <div class="modal fade" id="remove-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="post" enctype="multipart/form-data" v-on:submit.prevent="deleteItem(fillPost)">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                            <h4 class="modal-title" id="modal-label">fillPost
                                Delete Post Confirmation
                            </h4>
                        </div>
                        <div class="modal-body">
                            <p>
                                Do you really want to delete this post "<strong>@{{ fillPost.title }}</strong>" ?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-block btn-sm btn-danger">I'm sure to delete</button>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn btn-block btn-sm btn-default" data-dismiss="modal" aria-label="Close">Sorry, not yet.</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        {{-- End Delete Modal --}}

        <div class="row">
            <div class="col-sm-12">

                <div class="row">
                    <div class="col-sm-9">
                        <h3>List All Posts</h3>
                    </div>
                    <div class="col-sm-3">
                        <button class="btn btn-sm btn-priamry pull-right" @click.prevent="newItem">
                            <span class="glyphicon glyphicon-plus"></span> New Post
                        </button>
                    </div>
                </div>
                <hr/>

                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Summary</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in items">
                                <td>@{{ item.id }}</td>
                                <td>@{{ item.title }}</td>
                                <td>@{{ item.summary }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit-model" @click.prevent="editItem(item)">
                                        <span class="glyphicon glyphicon-edit"></span> Modify
                                    </button>
                                    <button class="btn btn-sm btn-danger edit-modal" @click.prevent="removeItem(item)">
                                        <span class="glyphicon glyphicon-trash"></span> Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div>
                        <ul class="pagination">
                            <li v-if="pagination.current_page > 1">
                                <a href="#" aria-label="Previous" @click.prevent="changePage(pagination.current_page - 1)">
                                    <span aria-hidden="true"><<</span>
                                </a>
                            </li>

                            <li v-for="page in pagesNumber" v-bind:class="[page == isActived ? 'active' : '']">
                                <a href="#" @click.prevent="changePage(page)">
                                    @{{ page }}
                                </a>
                            </li>

                            <li v-if="pagination.current_page < pagination.last_page">
                                <a href="#" aria-label="Next" @click.prevent="changePage(pagination.current_page + 1)">
                                    <span aria-hidden="true">>></span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
