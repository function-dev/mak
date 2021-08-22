<template>
    <div class="admin__block">
        <h2 class="admin__block-title">Редактировать роли</h2>
        <div class="admin__block-form">
            <div class="form__group">
                <label for="name" class="label">Название</label>
                <input type="text" id="name" class="input" v-model="name">
            </div>
            <div class="form__group">
                <label class="label">Сессия</label>
                <dropdown-component :options="sessions" @getOption="getSession"></dropdown-component>
            </div>
            <button class="btn" @click="newRole">Добавить роль</button>
        </div>
        <table class="admin__block-table">
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Доступные сессии</th>
                <th>Удалить</th>
            </tr>
            <tr v-for="role in roles">
                <td>{{ role.id }}</td>
                <td>{{ role.name }}</td>
                <td>{{ getSessionName(role.sessions) }}</td>
                <td><a href="#" @click="delRole(role.id)">Удалить</a></td>
            </tr>
        </table>
    </div>
</template>

<script>
export default {
    name: "RolesListComponent",

    data(){
        return{
            roles: {},
            sessions: {},
            name: '',
            session: '',
        }
    },

    methods: {
        getRoles(){
            axios
                .get('/api/get_roles_list')
                .then((data) => this.roles = data.data)
        },

        getSessions(){
            return axios
                .get('/api/get_sessions')
                .then((data) => {this.sessions = data.data})
        },

        getSession(data){
            this.session = data.option.id
        },

        newRole(){
            axios
                .post('/api/new_role', {
                    name: this.name,
                    session_id: this.session
                })
                .then(() => {this.getRoles()})

            this.name = ''
            this.session = {}
        },

        delRole(id){
            axios
                .post('/api/del_role', {
                    id: id
                })
                .then(() => {this.getRoles()})
        },

        getSessionName(id){
            let name = this.sessions.filter(session => session.id == id)

            return name[0].title
        }
    },

    mounted() {
      this.getRoles()
      this.getSessions()
    }
}
</script>
