<template>

    <Head>
        <title>لوحة التحكم - تطبيق الكاشير</title>
    </Head>

    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">

                <div class="row">
                    <div class="col-md-8">
                        <div v-if="hasAnyPermission(['dashboard.sales_chart'])" class="card border-0 rounded-3 shadow border-top-purple">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-chart-bar"></i> مخطط المبيعات لمدة 7 أيام</span>
                            </div>
                            <div class="card-body">
								<BarChart :chartData="chartSellWeek" :options="options" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div v-if="hasAnyPermission(['dashboard.sales_today'])" class="card border-0 rounded-3 shadow border-top-info mb-4">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-chart-line"></i> المبيعات اليوم</span>
                            </div>
                            <div class="card-body">
                                <strong>0</strong> مبيعات
                                <hr>
                                <h5 class="fw-bold">.دل 0</h5>
                            </div>
                        </div>

                        <div v-if="hasAnyPermission(['dashboard.profits_today'])" class="card border-0 rounded-3 shadow border-top-success">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-chart-bar"></i> الأرباح اليومية</span>
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold">.دل 0</h5>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div v-if="hasAnyPermission(['dashboard.best_selling_product'])" class="card border-0 rounded-3 shadow border-top-warning">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-chart-pie"></i> أفضل منتجات البيع</span>
                            </div>
                            <div class="card-body">
								<DoughnutChart :chartData="chartBestProduct" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div v-if="hasAnyPermission(['dashboard.product_stock'])" class="card border-0 rounded-3 shadow border-top-danger">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-box-open"></i> مخزون المنتجات</span>
                            </div>
                            <div class="card-body" dir="rtl">
								<div v-if="products_limit_stock.length > 0">
									<ol class="list-group list-group-numbered">
										<li v-for="product in products_limit_stock" :key="product.id" class="list-group-item d-flex justify-content-between align-items-end">
                                            <div class="me-2 ms-auto">
                                                <div class="fw-bold">{{ product.title }}</div>
                                                <div class="text-muted">الفئة : {{ product.category.name }}</div>
                                            </div>
                                            <span class="badge bg-danger rounded-pill text-right">{{ product.stock }}</span>
                                        </li>
									</ol>
								</div>
								<div v-else class="alert alert-danger border-0 shadow rounded-3">
                                    لا توجد بيانات متاحة!.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
</template>


<script>
    //import layout
    import LayoutApp from '../../../Layouts/App.vue';

    //import Heade and useForm from Inertia
    import { Head } from '@inertiajs/inertia-vue3';

	//import ref from vue
	import { ref } from 'vue';

	//chart
    import { BarChart, DoughnutChart } from 'vue-chart-3';
    import { Chart, registerables } from "chart.js";

	//register chart
	Chart.register(...registerables);

    export default {

        //layout
        layout: LayoutApp,

        //register component
        components: {
            Head,
			BarChart,
			DoughnutChart
        },

		props: {
			// total selling today
			count_sales_today: Number,

			// sum (.دل ) selling today
			sum_sales_today: Number,

			// total profit today
			sum_profits_today: Number,

			// chart sales
			sales_date: Array,
			grand_total: Array,

			// best selling product
			product: Array,
			total: Array,

			// product limit stock
			products_limit_stock: Array,
		},

		setup(props) {

			// method random color
			function randomBackgroundColor(length) {
				var data = [];
				for (var i = 0; i < length; i++) {
					data.push(getRandomColor());
				}

				return data;
			}

			// method generate random color
			function getRandomColor() {
				var letters = '0123456789ABCDEF'.split('');
				var color = '#';

				for (var i = 0; i < 6; i++) {
					color += letters[Math.floor(Math.random() * 16)];
				}

				return color;
			}

			// option chart
			const options = ref({
				responsive: true,
				plugins: {
					legend: {
						display: false
					},
					title: {
						display: false
					},
				},
				beginZero: true
			});

			// chart sell week
			const chartSellWeek = {
				labels: props.sales_data,
				datasets: [{
					data: props.grand_total,
					backgroundColor: randomBackgroundColor(5),
				}, ],
			};

			// chart top selling products
			const chartBestProduct = {
				labels: props.product,
				datasets: [{
					data: props.total,
					backgroundColor: randomBackgroundColor(5),
				}, ],
			};

			return {
				options,
				chartSellWeek,
				chartBestProduct
			}
		}
    }
</script>

<style>

</style>
