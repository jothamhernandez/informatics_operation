
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.moment = require('moment-business-days');
require('./prototypes');
require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Generic
Vue.component('user-typeahead',require('./components/UserTypeAhead.vue').default);

// Users Module
Vue.component('user-manager', require('./modules/users/UserManagerComponent.vue').default);
Vue.component('user-list', require('./modules/users/UserListComponent.vue').default);
Vue.component('user-form', require('./modules/users/UserFormComponent.vue').default);

// Center Module
Vue.component('center-manager', require('./modules/centers/CenterManagerComponent.vue').default);
Vue.component('center-list', require('./modules/centers/CenterListComponent.vue').default);
Vue.component('center-form', require('./modules/centers/CenterFormComponent.vue').default);
Vue.component('center-focus', require('./modules/centers/FocusCenterComponent.vue').default);

// Cluster Module
Vue.component('cluster-manager', require('./modules/clusters/ClusterManagerComponent.vue').default);
Vue.component('cluster-list', require('./modules/clusters/ClusterListComponent.vue').default);
Vue.component('cluster-form', require('./modules/clusters/ClusterFormComponent.vue').default);

// Employee Module 
Vue.component('employee-list', require('./modules/employees/EmployeeListComponent.vue').default);

// Manager Module
Vue.component('manager-manager', require('./modules/center_managers/ManagerManagerComponent.vue').default);

// KPI Module
Vue.component('kpi-manager', require('./modules/kpi/KPIManagerComponent.vue').default);
Vue.component('kpi-form', require('./modules/kpi/KPIFormComponent.vue').default);

// STR Module
Vue.component('str-manager', require('./modules/str/STRManagerComponent.vue').default);

// WAP Module
Vue.component('wap-manager', require('./modules/wap/WAPManagerComponent.vue').default);

// Client Module 
Vue.component('client-list', require('./modules/clients/ClientListComponent.vue').default);
Vue.component('client-form', require('./modules/clients/ClientFormComponent.vue').default);
Vue.component('client-record', require('./modules/clients/ClientRecordComponent.vue').default);


// Graph Module
Vue.component('graph-manager', require('./modules/graphs/GraphManagerComponent.vue').default);
Vue.component('kpi-graph', require('./modules/graphs/KPIGraphComponent.vue').default);

// Forgot Password
Vue.component('forgot-password', require('./components/ForgotPasswordComponent.vue').default);

// Feedback Component
Vue.component('feedback', require('./components/FeedbackComponent.vue').default);
Vue.component('feedback-form', require('./components/FeedbackFormComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.config.devtools = false
// Vue.config.debug = false
// Vue.config.silent = true;

const app = new Vue({
    el: '#app'
});


