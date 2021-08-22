<template>
    <div class="admin__block">
        <h2 class="admin__block-title">Редактировать сессии</h2>
        <button class="btn admin__block-btn" @click="form = 1">Добавить сессию</button>
        <div class="sessions__list">
            <div v-for="session in sessions" class="sessions__list-item" :style="'background-image: url(' + session.img + ')'">
                <img src="/img/del.svg" alt="delete" class="sessions__list-del" @click="delSession(session.id)">
                <p class="sessions__list-title">{{ session.title }}</p>
            </div>
        </div>
        <new-session-component @close="closeForm" v-if="form === 1"></new-session-component>
    </div>
</template>

<script>
export default {
    name: "SessionsComponent",

    data(){
        return{
            sessions: {},
            form: 0,
            temp: 0,
        }
    },

    methods:{
        getSessions(){
            return axios
                .get('/api/get_sessions')
                .then((data) => {this.sessions = data.data})
        },

        delSession(id){
            return axios
                .post('/api/del_session', {id: id})
                .then(() => {this.getSessions()})
        },

        closeForm(){
            if (this.temp === 0){
                this.temp = 1
            } else if (this.temp === 1){
                this.form = 0
                this.temp = 0

                this.getSessions()
            }
        },
    },

    mounted() {
        this.getSessions()
    }
}
</script>
