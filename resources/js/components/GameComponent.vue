<template>
    <div class="game">
        <img src="/img/del.svg" alt="close" class="game-close" @click="closeGame">
        <div class="game__selected">
            <img v-for="slot in selected" :src="slot" alt="empty" class="game__selected-item">
        </div>
        <h3 class="game__question">{{ qurrentQuestion }}</h3>
        <div class="game__cards">
            <img src="/img/left.svg" alt="left" class="game__cards-nav" @click="slideLeft">
            <div class="game__cards-viewport">
                <div class="game__cards-list" :style="'width:' + decks.length * 258 + 'px; transform: translateX(' + translate + 'px)'">
                    <img v-for="card in decks" :src="card" alt="card" class="game__cards-item" @click="selectCard(card)">
                </div>
            </div>
            <img src="/img/right.svg" alt="right" class="game__cards-nav" @click="slideRight">
        </div>
    </div>
</template>

<script>
export default {
    name: "GameComponent",

    data(){
        return{
            decks: {},
            questions: {},
            slots: 0,
            selected: [],
            width: 0,
            translate: 0,
            step: 0,
            qurrentQuestion: '',
        }
    },

    props: [
        'id'
    ],

    methods: {
        closeGame(){
            this.$emit('close')
        },
        getDecks(){
            axios
                .post('/api/game_decks', {
                    id: this.id
                })
                .then((data) => { this.decks = data.data })


        },

        getQuestions(){
            axios
                .post('/api/game_questions', {
                    id: this.id
                })
                .then((data) => { this.genSlots(data.data) })
        },

        genSlots(data){
            this.questions = data
            this.slots = this.questions.length

            for (let i = 0; i < this.slots; i++){
                this.selected.push('/img/empty.svg')
            }

            this.qurrentQuestion = this.questions[0].question
        },

        selectCard(card){
            if (this.step === this.slots){
                return
            } else if (this.step + 1 === this.slots){
                this.qurrentQuestion = ''
            }

            Vue.set(this.selected, this.step, card)
            this.step ++

            this.qurrentQuestion = this.questions[this.step].question
        },

        slideLeft(){
            let translate = this.translate

            if (translate < 0){
                translate = translate + 790
            }

            this.translate = translate
        },

        slideRight(){
            let translate = this.translate
            let max = this.decks.length / 3
            max = Math.ceil(max)
            max = (max - 1) * -790

            console.log(translate, max)

            if (translate !== max){
                translate = translate - 790
            }

            this.translate = translate
        }
    },

    mounted() {
        this.getDecks()
        this.getQuestions()
    }
}
</script>

<style scoped>

</style>
