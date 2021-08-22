<template>
    <div class="admin__block">
        <h2 class="admin__block-title">Пользователи</h2>
        <dropdown-component :options="users" @getOption="getUser"></dropdown-component>
        <dropdown-component :options="sortRoles" @getOption="getRole"></dropdown-component>
        <p v-if="response === 1">Успешно сохранено!</p>
        <button class="btn" @click="setRole">Сохранить</button>
        <button class="btn" @click="getRoles">Обновить таблицу</button>
        <table class="admin__block-table">
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Роль</th>
            </tr>
            <tr v-for="user in list">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.role.role }}</td>
            </tr>
        </table>
    </div>
</template>

<script>
export default {
    name: "RoleComponent",
    data() {
        return {
            users: {},
            selectedUser: {},
            roles: [],
            sortRoles: [],
            selectedRoles: 'user',
            response: 0,
            list: [],
        }
    },
    methods: {
        getUser(data){
            this.selectedUser = data.option
        },

        getRole(data){
            this.selectedRole = data.option
        },

        getUsers(){
            axios
                .get('/api/get_user')
                .then((data) => this.users = data.data)
        },

        getRoles(){
            axios
                .get('/api/get_roles')
                .then((data) => this.list = data.data)
        },

        getRolesList(){
            axios
                .get('/api/get_roles_list')
                .then((data) => {
                    this.roles = data.data
                    this.formatRole()
                })
        },

        formatRole(){
            this.roles.forEach((e) => {
                this.sortRoles.push(e.name)
            })
            this.sortRoles.push('user')
            this.sortRoles.push('admin')
        },

        setRole(){
            axios
                .post('/api/set_role', {
                    user: this.selectedUser,
                    role: this.selectedRole
                })
                .then((data) => this.response = data.data)
        }
    },

    mounted() {
        this.getUsers()
        this.getRoles()
        this.getRolesList()
    }
}
</script>
