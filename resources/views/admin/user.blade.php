@extends('admin.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="app">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">User</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Modal -->
        <div
            class="modal fade"
            id="staticBackdrop"
            data-backdrop="static"
            data-keyboard="false"
            tabindex="-1"
            aria-labelledby="staticBackdropLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">User</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Username</label>
                            <input v-model='form.username' id="name" type="text" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input v-model='form.email' id="email" type="email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input v-model="form.password" id="password" type="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="role">Role</label>
                            <select v-model='form.role' id="role" class="form-control">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            @click="hideModal()"
                            type="button"
                            class="btn btn-danger"
                        >Cancel
                        </button>
                        <button
                            v-if="status == 'add'"
                            @click="addUser()"
                            type="button"
                            class="btn btn-primary"
                        >Save
                        </button>
                        <button
                            v-if="status == 'edit'"
                            @click="doEdit()"
                            type="button"
                            class="btn btn-primary"
                        >Edit
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button
                                    href="#"
                                    class="btn btn-primary"
                                    @click="showModal()"
                                >
                                    <i class="fas fa-plus-circle"></i>
                                    Add
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr class="bg-primary">
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr
                                            v-for="(item, index) in user_list"
                                            :key="'user_list_'+index"
                                        >
                                            <td>[[ index + 1 ]]</td>
                                            <td>[[ item.name ]]</td>
                                            <td>[[ item.email ]]</td>
                                            <td>[[ item.role ]]</td>
                                            <td>
                                                <a href="#"
                                                   class='btn btn-sm btn-secondary'
                                                   @click="getEdit(item)"
                                                >Edit</a>
                                                <a
                                                    @click="deleteUser(item.id)"
                                                    href="#"
                                                    class='btn btn-sm btn-danger'
                                                >Delete</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
    <script>
        var app = new Vue({
            el: '#app',
            delimiters: ['[[', ']]'],
            created() {
                this.fetchUser()
            },
            data: {
                form: {
                    id: null,
                    username: null,
                    password: null,
                    role: 'user',
                },
                user_list: [],
                status: 'add'
            },
            methods: {
                showModal() {
                    $('#staticBackdrop').modal('show')
                },
                hideModal() {
                    this.resetForm()
                    $('#staticBackdrop').modal('hide')
                },
                fetchUser() {
                    let vm = this
                    $.LoadingOverlay("show");
                    axios.get('/admin/get-user')
                        .then(function (response) {
                            // handle success
                            vm.user_list = response.data
                            $.LoadingOverlay("hide");
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        });
                },
                addUser() {
                    let vm = this
                    let input = this.form
                    $.LoadingOverlay("show");
                    axios.post('/admin/add-user', input)
                        .then(function (response) {
                            // handle success
                            $.LoadingOverlay("hide");
                            vm.hideModal()
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        });
                },
                createUser() {
                    let vm = this
                    let input = vm.form
                },
                getEdit(item) {
                    let form = this.form
                    form.id = item.id
                    form.username = item.name
                    form.email = item.email
                    form.role = item.role

                    this.status = 'edit'
                    this.showModal()
                },
                doEdit() {
                    let vm = this
                    let input = this.form
                    $.LoadingOverlay("show");
                    axios.post('/admin/edit-user', input)
                        .then(function (response) {
                            // handle success
                            if (response.status === 200) {
                                vm.resetForm()
                                vm.fetchUser()
                                $('#staticBackdrop').modal('hide')
                                $.LoadingOverlay("hide");
                            }

                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        });
                },
                deleteUser(id) {
                    Swal.fire({
                        icon: 'question',
                        title: "Do you want to Delete ?",
                        showCancelButton: true,
                        confirmButtonText: "Delete",
                        denyButtonText: `Cancel`
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let vm = this
                            $.LoadingOverlay("show");
                            axios.post('/admin/delete-user', {id: id})
                                .then(function (response) {
                                    // handle success
                                    vm.fetchUser()
                                    $.LoadingOverlay("hide");
                                })
                                .catch(function (error) {
                                    // handle error
                                    console.log(error);
                                });
                        }
                    });
                },
                resetForm() {
                    this.form = {
                        id: null,
                        username: null,
                        password: null,
                        role: 'user',
                    }
                    this.status = 'add'
                }
            }
        })
    </script>
@endsection
