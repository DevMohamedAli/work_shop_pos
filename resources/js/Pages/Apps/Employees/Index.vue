<template>
	<Head>
		<title>الموظفون - نظام أبوحصان</title>
	</Head>
	<main class="c-main">
		<div class="container-fluid">
			<div class="fade-in">
				<div class="row">
					<div class="col-md-12">
						<div class="card border-0 rounded-3 shadow border-top-purple">
							<div class="card-header">
								<span class="font-weight-bold"><i class="fa fa-user-circle"></i>الموظفون</span>
							</div>
							<div class="card-body">
								<form @submit.prevent="handleSearch">
                                    <div class="input-group mb-3">
                                        <Link href="/apps/employees/create" v-if="hasAnyPermission(['employees.create'])" class="btn btn-primary input-group-text"> <i class="fa fa-plus-circle me-2"></i>موظف جديد</Link>
                                        <input type="text" v-model="search" class="form-control" placeholder="البحث بإسم الموظف">

                                        <button class="btn btn-primary input-group-text" type="submit"> <i class="fa fa-search me-2"></i> بحث</button>

                                    </div>
                                </form>
								<table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">الاسم بالكامل</th>
                                            <th scope="col">التخصص</th>
                                            <th scope="col">رقم الهاتف</th>
                                            <th scope="col">رقم اقرب الاقروبن</th>
                                            <th scope="col">فصيلة الدم</th>
                                            <th scope="col">نسبة العمولة</th>
                                            <th scope="col">العنوان</th>
                                            <th scope="col" style="width:20%">العمليات</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(customer, index) in employees.data" :key="index">
                                            <td>{{ customer.name }}</td>
                                            <td>{{ customer.specialization }}</td>
                                            <td>{{ customer.phone }}</td>
                                            <td>{{ customer.relatives_phone }}</td>
                                            <td>{{ customer.blood_type }}</td>
                                            <td>{{ customer.commission_rate }}</td>
                                            <td>{{ customer.address }}</td>
                                            <td class="text-center">
                                                <Link :href="`/apps/employees/${customer.id}/edit`" v-if="hasAnyPermission(['employees.edit'])" class="btn btn-success btn-sm me-2"><i class="fa fa-pencil-alt me-1"></i> تعديل</Link>
                                                <button @click.prevent="destroy(customer.id)" v-if="hasAnyPermission(['employees.delete'])" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> حدف</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <Pagination v-if="employees.meta" :meta="employees.meta" :links="employees.links" />
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

        // register components
        components: {
            Head,
            Link,
            Pagination
        },

        // props
        props: {
            employees: Object,
        },

		// composition api
		setup() {
			// define state search
			const search = ref('' || (new URL(document.location)).searchParams.get('q'));

			// define method search
			const handleSearch = () => {
				Inertia.get('/apps/employees', {
					// send params 'q' with value from state 'search'
					q: search.value
				});
			}

			// define method destroy
			const destroy = (id) => {
				Swal.fire({
					title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
				})
				.then((result) => {
					if (result.isConfirmed) {
						Inertia.delete(`/apps/employees/${id}`);

						Swal.fire({
                            title: 'Deleted!',
                            text: 'Customer deleted successfully.',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false,
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
