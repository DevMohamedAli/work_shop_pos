<template>
	<Head>
		<title>إنشاء الفئة - نظام أبوحصان</title>
	</Head>
	<main class="c-main">
		<div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 rounded-3 shadow border-top-purple">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-folder"></i> إضافة فئة جديدة</span>
                            </div>
                            <div class="card-body">

                                <form @submit.prevent="submit">
                                    <div class="mb-3">
                                        <input class="form-control" @input="form.image = $event.target.files[0]" :class="{ 'is-invalid': errors.image }" type="file">
                                    </div>
                                    <div v-if="errors.image" class="alert alert-danger">
                                        {{ errors.image }}
                                    </div>
                                    <div class="mb-3">
                                        <label class="fw-bold">اسم الفئة</label>
                                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': errors.name }" type="text" placeholder="اسم الفئة">
                                    </div>
                                    <div v-if="errors.name" class="alert alert-danger">
                                        {{ errors.name }}
                                    </div>
                                    <div class="mb-3">
                                        <label class="fw-bold">الوصف</label>
                                        <textarea class="form-control" v-model="form.description" :class="{ 'is-invalid': errors.description }" type="text" rows="4" placeholder="الوصف"></textarea>
                                    </div>
                                    <div v-if="errors.description" class="alert alert-danger">
                                        {{ errors.description }}
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-primary shadow-sm rounded-sm" type="submit">حفظ</button>
                                            <button class="btn btn-warning shadow-sm rounded-sm ms-3" type="reset">إعادة تعيين</button>
                                        </div>
                                    </div>
                                </form>

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

	// import Head and Link from Inertia
	import { Head, Link } from '@inertiajs/inertia-vue3';

	// import ref from vue
	import { reactive } from 'vue';

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
			Link
		},

		// props
		props: {
			errors: Object
		},

		// composition api
		setup() {

			//define form with reactive
			const form = reactive({
				name: '',
				image: '',
				description: ''
			});

			//method "submit"
			const submit = () => {

				//send data to server
				Inertia.post('/apps/categories', {
					//data
					name: form.name,
					image: form.image,
					description: form.description
				}, {
					onSuccess: () => {
						//show success alert
						Swal.fire({
							title: 'Success!',
							text: 'تم حفظ الفئة بنجاح.',
							icon: 'success',
							showConfirmButton: false,
							timer: 2000
						});
					},
				});

			}

			return {
				form,
				submit,
			}

		}
	}
</script>
