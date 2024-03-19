
<template>
	<Head>
		<title>الأدوار - نظام أبوحصان</title>
	</Head>
	<main class="c-main">
		<div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 rounded-3 shadow border-top-purple">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-shield-alt"></i> الأدوار</span>
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="handleSearch">
                                    <div class="input-group mb-3">
                                        <Link href="/apps/roles/create" v-if="hasAnyPermission(['roles.create'])" class="btn btn-primary input-group-text"> <i class="fa fa-plus-circle me-2"></i> جديد</Link>
                                        <input type="text" class="form-control" v-model="search" placeholder="البحث حسب اسم الدور...">

                                        <button class="btn btn-primary input-group-text" type="submit"> <i class="fa fa-search me-2"></i> بحث</button>

                                    </div>
                                </form>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">اسم الدور</th>
                                            <th scope="col" style="width:50%">الصلاحيات</th>
                                            <th scope="col" style="width:20%">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(role, index) in roles.data" :key="index">
                                            <td>{{ role.name }}</td>
                                            <td>
                                                <span v-for="(permission, index) in role.permissions" :key="index" class="badge badge-primary shadow border-0 ms-2 mb-2">
                                                    {{ permission.name }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <Link :href="`/apps/roles/${role.id}/edit`" v-if="hasAnyPermission(['roles.edit'])" class="btn btn-success btn-sm me-2"><i class="fa fa-pencil-alt me-1"></i> تعديل</Link>
                                                <button @click.prevent="destroy(role.id)" v-if="hasAnyPermission(['roles.delete'])" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> حذف</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <Pagination :links="roles.links" align="end"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</main>
</template>

<script>
	// استيراد القالب المستخدم
	import LayoutApp from '../../../Layouts/App.vue';

	// استيراد مكون التصفح
	import Pagination from '../../../Components/Pagination.vue';

	// استيراد Head و Link من Inertia
	import { Head, Link } from '@inertiajs/inertia-vue3';

    // استيراد ref من vue
    import { ref } from 'vue';

    // استيراد Inertia من آداب الاستفراغ
    import { Inertia } from '@inertiajs/inertia';

    // استيراد Swal
    import Swal from 'sweetalert2';

	export default {
		// تحديد التخطيط
		layout: LayoutApp,

		// تسجيل مكون
		components: {
			Head,
			Link,
			Pagination
		},

		props: {
			roles: Object,
		},

        setup() {
            // تعريف البحث
            const search = ref('' || (new URL(document.location)).searchParams.get('q'));

            // تعريف طريقة البحث
            const handleSearch = () => {
                Inertia.get('/apps/roles', {
                    // إرسال قيمة البحث من حالة البحث
                    q: search.value,
                });
            }

            // تعريف طريقة الحذف
            const destroy = (id) => {
                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: "لن تتمكن من التراجع عن هذا!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'نعم، احذفه!'
                }).then((result) => {
                    if(result.isConfirmed) {
                        Inertia.delete(`/apps/roles/${id}`);

                        Swal.fire({
                            title: 'تم الحذف!',
                            text: 'تم حذف الدور بنجاح.',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                    }
                });
            }

            return {
                search,
                handleSearch,
                destroy,
            }
        }
	}
</script>

<style>

</style>
