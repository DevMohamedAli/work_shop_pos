<template>
	<Head>
		<title>services - نظام أبوحصان</title>
	</Head>
	<main class="c-main">
		<div class="container-fluid">
			<div class="fade-in">
				<div class="row">
					<div class="col-md-12">
						<div class="card border-0 rounded-3 shadow border-top-purple">
							<div class="card-header">
								<span class="font-weight-bold"><i class="fa fa-user-circle"></i>الخدمات</span>
							</div>
							<div class="card-body">
								<form @submit.prevent="handleSearch">
                                    <div class="input-group mb-3">
                                        <Link href="/apps/services/create" v-if="hasAnyPermission(['services.create'])" class="btn btn-primary input-group-text"> <i class="fa fa-plus-circle me-2"></i>جديد</Link>
                                        <input type="text" v-model="search" class="form-control" placeholder="بحث بإسم الخدمة">

                                        <button class="btn btn-primary input-group-text" type="submit"> <i class="fa fa-search me-2"></i> بحث</button>

                                    </div>
                                </form>
								<table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">الاسم</th>
                                            <th scope="col">الوصف</th>
                                            <th scope="col">السعر</th>
                                            <th scope="col" style="width:20%">العماليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(service, index) in services.data" :key="index">
                                            <td>{{ service.name }}</td>
                                            <td>{{ service.description }}</td>
                                            <td>{{ service.price }}</td>
                                            <td class="text-center">
                                                <Link :href="`/apps/services/${service.id}/edit`" v-if="hasAnyPermission(['services.edit'])" class="btn btn-success btn-sm me-2"><i class="fa fa-pencil-alt me-1"></i> تعديل</Link>
                                                <button @click.prevent="destroy(service.id)" v-if="hasAnyPermission(['services.delete'])" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> حدف</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <Pagination :links="services.links" align="end"/>
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
            services: Object,
        },

		// composition api
		setup() {
			// define state search
			const search = ref('' || (new URL(document.location)).searchParams.get('q'));

			// define method search
			const handleSearch = () => {
				Inertia.get('/apps/services', {
					// send params 'q' with value from state 'search'
					q: search.value
				});
			}

			// define method destroy
			const destroy = (id) => {
				Swal.fire({
					title: 'هل أنت متأكد?',
                    text: "هذه العملية غير قابلة لتراجع!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'موافق !',
				})
				.then((result) => {
					if (result.isConfirmed) {
						Inertia.delete(`/apps/services/${id}`);

						Swal.fire({
                            title: 'Deleted!',
                            text: 'تم حدف الخدمة بنجاخ!',
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
