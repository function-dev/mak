<template>
    <div class="admin__block">
        <h2 class="admin__block-title">Редактировать колоды</h2>
        <div class="decks__list">
            <div class="decks__list-item" v-for="deck in decks" @click="changeDeck(deck.id, deck.title)">
                <img src="/img/del.svg" alt="delete" class="decks__list-del" @click="delDeck(deck.id)">
                <p class="decks__list-title">{{ deck.title }}</p>
            </div>
            <img src="/img/empty-card.svg" alt="add-decks" class="decks__list-new" @click="form = 1">
        </div>
        <deck-component :deckId="deckId" :deckTitle="deckTitle"></deck-component>
        <new-deck-component v-if="form === 1" @close="closeForm" @added="refreshDecks"></new-deck-component>
    </div>
</template>

<script>
export default {
    name: "DecksComponent",
    data() {
        return {
            form: 0,
            temp: 0,
            decks: {},
            deckId: null,
            deckTitle: ''
        }
    },
    methods: {
        closeForm(){
            if (this.temp === 0){
                this.temp = 1
            } else if (this.temp === 1){
                this.form = 0
                this.temp = 0

                this.getDecks()
            }
        },

        refreshDecks(){
            this.form = 0
            this.temp = 0
            this.getDecks()
        },

        getDecks(){
            return axios
                .get('/api/get_decks')
                .then((data) => this.decks = data.data.reverse())
        },

        delDeck(id){
            axios
                .post('/api/del_deck', {id: id})
            this.getDecks()
        },

        changeDeck(id, title){
            this.deckId = id
            this.deckTitle = title
        }
    },

    mounted() {
        this.getDecks()
    }
}
</script>
