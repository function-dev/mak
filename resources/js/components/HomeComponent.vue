<template>
    <div class="container">
        <div class="block">
            <h2 class="block-title">Доступные сессии</h2>
            <div class="sessions__list">
                <div v-for="session in sessions" class="sessions__list-item" :style="'background-image: url(' + session.img + ')'" @click="gameId = session.id">
                    <p class="sessions__list-title">{{ session.title }}</p>
                </div>
            </div>
        </div>
        <game-component v-if="gameId !== 0" :id="gameId" @close="gameId = 0"></game-component>
    </div>
</template>

<script>
export default {
    name: "HomeComponent",

    props: [
      'user_id'
    ],

    data(){
        return {
            sessions: {},
            gameId: 0,
        }
    },

    methods: {
        getSessions(){
            return axios
                .post('/api/get_user_sessions', {
                    id: this.user_id,
                })
                .then((data) => {this.sessions = data.data})
        },
    },

    mounted() {
        this.getSessions()
    }
}
</script>
