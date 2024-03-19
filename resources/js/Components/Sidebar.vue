<template>
	<ul class="c-sidebar-nav">
		<li class="c-sidebar-nav-item">
			<Link class="c-sidebar-nav-link" v-if="hasAnyPermission(['dashboard.index'])"
				:class="{ active: $page.url.startsWith('/apps/dashboard') }" href="/apps/dashboard">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
				class="bi bi-speedometer2" viewBox="0 0 16 16">
				<path
					d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z" />
				<path fill-rule="evenodd"
					d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z" />
			</svg>
			<span class="ms-2
            ">لوحة القيادة</span>
			</Link>
		</li>

		<li class="c-sidebar-nav-title" v-if="
			hasAnyPermission(['categories.index']) ||
			hasAnyPermission(['products.index'])
		">
			رئيسي
		</li>

		<li class="c-sidebar-nav-item" v-if="hasAnyPermission(['categories.index'])">
			<Link class="c-sidebar-nav-link" href="/apps/categories"
				:class="{ active: $page.url.startsWith('/apps/categories') }">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder"
				viewBox="0 0 16 16">
				<path
					d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z" />
			</svg>
			<span class="ms-2">الفئات</span>
			</Link>
		</li>

		<li class="c-sidebar-nav-item" v-if="hasAnyPermission(['products.index'])">
			<Link class="c-sidebar-nav-link" href="/apps/products"
				:class="{ active: $page.url.startsWith('/apps/products') }">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag"
				viewBox="0 0 16 16">
				<path
					d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
			</svg>
			<span class="ms-2">المنتجات</span>
			</Link>
		</li>

		<li class="c-sidebar-nav-item" v-if="hasAnyPermission(['customers.index'])">
			<Link class="c-sidebar-nav-link" href="/apps/customers"
				:class="{ active: $page.url.startsWith('/apps/customers') }">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
				class="bi bi-person-circle" viewBox="0 0 16 16">
				<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
				<path fill-rule="evenodd"
					d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
			</svg>
			<span class="ms-2">العملاء</span>
			</Link>
		</li>

        <!-- employees -->
        <li class="c-sidebar-nav-item" v-if="hasAnyPermission(['employees.index'])">
            <Link class="c-sidebar-nav-link" href="/apps/employees"
                :class="{ active: $page.url.startsWith('/apps/employees') }">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-people" viewBox="0 0 16 16">
                    <path
                        d="M.5 3.5A2.5 2.5 0 0 1 3 1h10a2.5 2.5 0 0 1 2.5 2.5v9a2.5 2.5 0 0 1-2.5 2.5H3A2.5 2.5 0 0 1 .5 12v-9zm1 0V12a1.5 1.5 0 0 0 1.5 1.5h10A1.5 1.5 0 0 0 14 12V3.5A1.5 1.5 0 0 0 12.5 2h-1V1a1 1 0 0 0-1-1h-3a1 1 0 0 0-1 1v1h-1A1.5 1.5 0 0 0 1 3.5z" />
                    <path
                        d="M8 7a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                </svg>
                <span class="ms-2">الموظفون</span>
            </Link>
        </li>
        <!-- services -->
        <li class="c-sidebar-nav-item" v-if="hasAnyPermission(['services.index'])">
            <Link class="c-sidebar-nav-link" href="/apps/services"
                :class="{ active: $page.url.startsWith('/apps/services') }">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-tools" viewBox="0 0 16 16">
                    <path
                        d="M.5 3.5A2.5 2.5 0 0 1 3 1h10a2.5 2.5 0 0 1 2.5 2.5v9a2.5 2.5 0 0 1-2.5 2.5H3A2.5 2.5 0 0 1 .5 12v-9zm1 0V12a1.5 1.5 0 0 0 1.5 1.5h10A1.5 1.5 0 0 0 14 12V3.5A1.5 1.5 0 0 0 12.5 2h-1V1a1 1 0 0 0-1-1h-3a1 1 0 0 0-1 1v1h-1A1.5 1.5 0 0 0 1 3.5z" />
                    <path
                        d="M8 7a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                </svg>
                <span class="ms-2">الخدمات</span>
            </Link>
        </li>

		<li class="c-sidebar-nav-title" v-if="hasAnyPermission(['transactions.index'])">
			المعاملات
		</li>

		<li class="c-sidebar-nav-item" v-if="hasAnyPermission(['transactions.index'])">
			<Link class="c-sidebar-nav-link" href="/apps/transactions"
				:class="{ active: $page.url.startsWith('/apps/transactions') }">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart"
				viewBox="0 0 16 16">
				<path
					d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
			</svg>
			<span class="ms-2">المعاملات</span>
			</Link>
		</li>

		<li class="c-sidebar-nav-title" v-if="
			hasAnyPermission(['sales.index']) ||
			hasAnyPermission(['profits.index'])
		">
			التقارير
		</li>

		<li class="c-sidebar-nav-item" v-if="hasAnyPermission(['sales.index'])">
			<Link class="c-sidebar-nav-link" href="/apps/sales"
				:class="{ active: $page.url.startsWith('/apps/sales') }">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart"
				viewBox="0 0 16 16">
				<path
					d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z" />
			</svg>
			<span class="ms-2">تقرير المبيعات</span>
			</Link>
		</li>
		<li class="c-sidebar-nav-item" v-if="hasAnyPermission(['profits.index'])">
			<Link class="c-sidebar-nav-link" href="/apps/profits"
				:class="{ active: $page.url.startsWith('/apps/profits') }">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
				class="bi bi-graph-up-arrow" viewBox="0 0 16 16">
				<path fill-rule="evenodd"
					d="M0 0h1v15h15v1H0V0Zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z" />
			</svg>
			<span class="ms-2">تقرير الأرباح</span>
			</Link>
		</li>

		<li class="c-sidebar-nav-title" v-if="
			hasAnyPermission(['roles.index']) ||
			hasAnyPermission(['permissions.index']) ||
			hasAnyPermission(['users.index'])
		">
			إدارة المستخدمين
		</li>

		<li class="c-sidebar-nav-item" v-if="hasAnyPermission(['roles.index'])">
			<Link class="c-sidebar-nav-link" href="/apps/roles"
				:class="{ active: $page.url.startsWith('/apps/roles') }">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
				class="bi bi-shield-check" viewBox="0 0 16 16">
				<path
					d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
				<path
					d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
			</svg>
			<span class="ms-2">الأدوار</span>
			</Link>
		</li>

		<li class="c-sidebar-nav-item" v-if="hasAnyPermission(['permissions.index'])">
			<Link class="c-sidebar-nav-link" href="/apps/permissions"
				:class="{ active: $page.url.startsWith('/apps/permissions') }">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key"
				viewBox="0 0 16 16">
				<path
					d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
				<path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
			</svg>
			<span class="ms-2">الأذونات</span>
			</Link>
		</li>

		<li class="c-sidebar-nav-item" v-if="hasAnyPermission(['users.index'])">
			<Link class="c-sidebar-nav-link" href="/apps/users"
				:class="{ active: $page.url.startsWith('/apps/users') }">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
				class="bi bi-people" viewBox="0 0 16 16">
				<path
					d="M4 9a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm8-1a3 3 0 1 0-6 0 3 3 0 0 0 6 0zm-1.5 4a.5.5 0 0 1 .5.5v1a2.5 2.5 0 0 1-5 0v-1a.5.5 0 0 1 1 0v1a1.5 1.5 0 0 0 3 0v-1a.5.5 0 0 1 .5-.5z" />
				<path fill-rule="evenodd"
					d="M.5 3.5A2.5 2.5 0 0 1 3 1h10a2.5 2.5 0 0 1 2.5 2.5v9a2.5 2.5 0 0 1-2.5 2.5H3A2.5 2.5 0 0 1 .5 12v-9zM3 2a1.5 1.5 0 0 0-1.5 1.5v9A1.5 1.5 0 0 0 3 14h10a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 13 2H3z" />
			</svg>
			<span class="ms-2">المستخدمون</span>
			</Link>
		</li>
	</ul>
</template>


<script>

// import link
import { Link } from '@inertiajs/inertia-vue3';

export default {
	components: {
		Link
	}
};
</script>

<style>


</style>
