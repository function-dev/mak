<template>
    <div class="deck" v-if="deckId !== null">
        <h2 class="deck-title">{{ deckTitle }} - {{ cards.length }} карт</h2>
        <div class="deck__list">
            <div class="deck__list__item" v-for="card in cards">
                <img src="/img/del.svg" alt="delete" class="deck__list__item-del" @click="delCard(card.id)">
                <img :src="card.card_img" :alt="deckTitle" class="deck__list__item-img">
            </div>
            <img src="/img/empty-card.svg" alt="add-card" class="deck__list-add" @click="form = 1">
        </div>
        <new-card-component v-if="form === 1" @close="closeForm" :deckId="deckId"></new-card-component>
    </div>
</template>

<script>
export default {
    name: "DeckComponent",
    data() {
        return {
            form: 0,
            temp: 0,
            cards: {},
        }
    },

    props: [
        'deckId',
        'deckTitle'
    ],

    methods: {
        closeForm(){
            if (this.temp === 0){
                this.temp = 1
            } else if (this.temp === 1){
                this.form = 0
                this.temp = 0
                this.getCards()
            }
        },

        getCards(){
            axios
                .post('/api/get_cards', {id: this.deckId})
                .then((data) => this.cards = data.data)
        },

        delCard(id){
            axios
                .post('/api/del_card', {id: id})
                .then(() => this.getCards())

        }
    },

    watch:{
        deckId: function (){
            this.getCards()
        }
    }
}
</script>
