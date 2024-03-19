<template>
	<Head>
		<title>إضافة موظف جديد - نضام ابوحصان</title>
	</Head>
	<main class="c-main">
		<div class="container-fluid">
			<div class="fade-in">
				<div class="row">
					<div class="col-md-12">
						<div class="card border-0 rounded-3 shadow border-top-purple">
							<div class="card-header">
								<span class="font-weight-bold"><i class="fa fa-user-circle"></i>إضافة موظف جديد</span>
							</div>
							<div class="card-body">
								<form @submit.prevent="submit">
									<div class="row">
										<div class="col-md-6">
											<div class="mb-3">
												<label class="fw-bold">الاسم بالكامل</label>
												<input type="text" v-model="form.name" class="form-control" :class="{ 'is-invalid': errors.name }" placeholder="الاسم بالكامل">
											</div>
											<div v-if="errors.name" class="alert alert-danger">
												{{ errors.name }}
											</div>
										</div>
										<div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">الاختصاص</label>
                                                <input type="text" v-model="form.specialization" class="form-control" :class="{ 'is-invalid': errors.specialization }" placeholder="الاختصاص">
                                            </div>
                                            <div v-if="errors.specialization" class="alert alert-danger">
                                                {{ errors.specialization }}
                                            </div>
                                        </div>
                                        <!-- phone -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">رقم الهاتف</label>
                                                <input type="text" v-model="form.phone" class="form-control" :class="{ 'is-invalid': errors.phone }" placeholder="الهاتف">
                                            </div>
                                            <div v-if="errors.phone" class="alert alert-danger">
                                                {{ errors.phone }}
                                            </div>
                                        </div>
                                        <!-- relatives phone -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">هاتف اقرب الاقارب</label>
                                                <input type="text" v-model="form.relatives_phone" class="form-control" :class="{ 'is-invalid': errors.relatives_phone }" placeholder="هاتف اقرب الاقارب">
                                            </div>
                                            <div v-if="errors.relatives_phone" class="alert alert-danger">
                                                {{ errors.relatives_phone }}
                                            </div>
                                        </div>
                                        <!-- blood type -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">فصيلة الدم</label>
                                                <input type="text" v-model="form.blood_type" class="form-control" :class="{ 'is-invalid': errors.blood_type }" placeholder="فصيلة الدم">
                                            </div>
                                            <div v-if="errors.blood_type" class="alert alert-danger">
                                                {{ errors.blood_type }}
                                            </div>
                                        </div>
                                        <!-- commission_rate -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">نسبة العمولة</label>
                                                <input type="text" v-model="form.commission_rate" class="form-control" :class="{ 'is-invalid': errors.commission_rate }" placeholder="نسبة العمولة">
                                            </div>
                                            <div v-if="errors.commission_rate" class="alert alert-danger">
                                                {{ errors.commission_rate }}
                                            </div>
                                        </div>
                                        <!-- address -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">العنوان</label>
                                                <textarea class="form-control" v-model="form.address" :class="{ 'is-invalid': errors.address }" type="text" rows="4" placeholder="العنوان"></textarea>
                                            </div>
                                            <div v-if="errors.address" class="alert alert-danger">
                                                {{ errors.address }}
                                            </div>
                                        </div>
									</div>

                                    <div class="row">
                                        <div class="col-12 text-start">
                                            <button class="btn btn-primary shadow-sm rounded-sm" type="submit">حفظ</button>
                                            <button class="btn btn-warning shadow-sm rounded-sm ms-3" type="reset">مسح</button>
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

	// import reactive from vue
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

		// composition API
		setup() {
			// define form with reactive
			const form = reactive({
				name: '',
                specialization: '',
                phone: '',
                relatives_phone: '',
                blood_type: '',
                address: '',
                'commission_rate': ''

			});

			// method submit
			const submit = () => {
				// send data to server
				Inertia.post('/apps/employees', {
					// data
                    name: form.name,
                    specialization: form.specialization,
                    phone: form.phone,
                    relatives_phone: form.relatives_phone,
                    blood_type: form.blood_type,
                    address: form.address,
                    commission_rate: form.commission_rate
				}, {
					onSuccess: () => {
						// show success alert
						Swal.fire({
							title: 'نجاح!',
                            text: 'تمت إضافة الموظف بنجاح!',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
						});
					}
				});
			}

			return {
				form,
				submit
			}
		}
	}
</script>
