<template>
    <div class="card">
        <div class="card-header">Employees <button class="btn btn-primary float-right">Add Employee</button></div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="employee in employees" :key="employee.id">
                        <td>{{employee.uid}}</td>
                        <td>{{employee.name}}</td>
                        <td>{{employee.position}}</td>
                        <td>{{employee.role}}</td>
                        <td>
                            <button class="btn btn-danger">Suspend</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        employees: Array
    }
}
</script>

<style>

</style>
