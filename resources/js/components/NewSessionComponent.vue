<template>
    <div class="form">
        <div class="form-body" v-click-outside="close" v-if="step === 1">
            <h2 class="form-title">Добавить сессию</h2>
            <div class="form__group">
                <label for="title" class="label form__group-label">Название сессии</label>
                <input type="text" id="title" class="input form__group-input" v-model="title">
            </div>
            <div class="form__group">
                <label for="file" class="label form__group-label">Картинка сессии</label>
                <input type="file" id="file" class="input form__group-input" ref="files" @change="changeFile" accept="image/*">
            </div>
            <button class="btn" @click="step = 2">Далее</button>
        </div>
        <div class="form-body" v-click-outside="close" v-if="step === 2">
            <h2 class="form-title">Добавить сессию</h2>
            <div class="form__list">
                <div class="form__group" v-for="item in questionKey">
                    <label class="label form__group-label">Вопрос #{{ item }}</label>
                    <input type="text" class="input form__group-input" v-model="questions[item - 1]">
                </div>
            </div>
            <button class="btn" @click="questionKey++">Добавить</button>
            <button class="btn" @click="step = 3">Далее</button>
        </div>
        <div class="form-body" v-click-outside="close" v-if="step === 3">
            <h2 class="form-title">Добавить сессию</h2>
            <div class="form__list">
                <div class="decks__list-item" v-for="deck in decks" @click="addDeck(deck.id, deck.title)">
                    <p class="decks__list-title">{{ deck.title }}</p>
                </div>
            </div>
            <p>Выбранные колоды: {{ showDecks }}</p>
            <button class="btn" @click="saveSession">Сохранить</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "NewSessionComponent",

    data(){
        return{
            title: '',
            file: '',
            step: 1,
            questionKey: 1,
            questions: [],
            decks: [],
            selectedDecks: [],
            showDecks: []
        }
    },

    methods:{
        close(){
            this.$emit('close')
        },

        changeFile(){
            this.file = this.$refs.files.files
        },

        getDecks(){
            return axios
                .get('/api/get_decks')
                .then((data) => this.decks = data.data.reverse())
        },

        addDeck(id, title){
            let check = this.selectedDecks.filter(deck => deck === id)

            if (check.length === 0){
                this.selectedDecks.push(id)
                this.showDecks.push(title)
            } else {
                let index = this.selectedDecks.indexOf(id)
                if (index > -1) {
                    this.selectedDecks.splice(index, 1)
                    this.showDecks.splice(index, 1)
                }

            }
        },

        saveSession(){
            let formData = new FormData()
            for (let i = 0; i < this.file.length; i++) {
                let file = this.file[i]
                formData.append('files[' + i + ']', file)
            }
            formData.append('title', this.title)
            formData.append('questions', this.questions)
            formData.append('decks', this.selectedDecks)

            axios
                .post('/api/save_session',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                )
                .then(() => {this.close()})
        }
    },

    mounted() {
        this.getDecks()
    }
}
</script>
