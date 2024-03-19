<template>
    <Head>
        <title>المستخدمون - نظام أبوحصان</title>
    </Head>
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 rounded-3 shadow border-top-purple">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-users"></i> المستخدمون</span>
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="handleSearch">
                                    <div class="input-group mb-3">

                                        <Link href="/apps/users/create" v-if="hasAnyPermission(['users.create'])" class="btn btn-primary input-group-text"> <i class="fa fa-plus-circle me-2"></i> جديد</Link>

                                        <input type="text" class="form-control" v-model="search" placeholder="البحث بواسطة اسم المستخدم...">

                                        <button class="btn btn-primary input-group-text" type="submit"> <i class="fa fa-search me-2"></i> بحث</button>

                                    </div>
                                </form>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">الاسم الكامل</th>
                                            <th scope="col">البريد الإلكتروني</th>
                                            <th scope="col">الأدوار</th>
                                            <th scope="col" style="width:20%">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(user, index) in users.data" :key="index">
                                            <td>{{ user.name }}</td>
                                            <td>{{ user.email }}</td>
                                            <td>
                                                <span v-for="(role, index) in user.roles" :key="index" class="badge badge-primary shadow border-0 ms-2 mb-2">
                                                    {{ role.name }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <Link :href="`/apps/users/${user.id}/edit`" v-if="hasAnyPermission(['users.edit'])" class="btn btn-success btn-sm me-2"><i class="fa fa-pencil-alt me-1"></i> تعديل</Link>
                                                <button @click.prevent="destroy(user.id)" v-if="hasAnyPermission(['users.delete'])" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> حذف</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <Pagination :links="users.links" align="end"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
    // import layout
    import LayoutApp from '../../../Layouts/App.vue';

    // import component pagination
    import Pagination from '../../../Components/Pagination.vue';

    // import Head and Link from Inertia
    import { Head, Link } from '@inertiajs/inertia-vue3';

    // import ref from vue
    import { ref } from 'vue';

    // import Inertia adapter
    import { Inertia } from '@inertiajs/inertia';

    // import sweetalert2
    import Swal from 'sweetalert2';

    export default {
        // layout
        layout: LayoutApp,

        // register component
        components: {
            Head,
            Link
        },

        // props
        props: {
            users: Object
        },

        setup() {
            // define state search
            const search = ref('' || (new URL(document.location)).searchParams.get('q'));

            // define method search
            const handleSearch = () => {
                Inertia.get('/apps/users', {
                    // send params 'q' with value from state 'search'
                    q: search.value
                });
            }

            // define method destroy
            const destroy = (id) => {
                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: "لن تتمكن من التراجع عن هذا!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'نعم، احذفها!'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        Inertia.delete(`/apps/users/${id}`);

                        Swal.fire({
                            title: 'تم الحذف!',
                            text: 'تم حذف المستخدم بنجاح.',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                })
            }

            return {
                search,
                handleSearch,
                destroy
            }
        }
    }
</script>

<style>

</style>
