<template>
    <div class="form">
        <div class="form-body" v-click-outside="close">
            <h2 class="form-title">Добавить колоду</h2>
            <div class="form__group">
                <label for="title" class="label form__group-label">Название колоды</label>
                <input type="text" id="title" class="input form__group-input" v-model="title">
            </div>
            <button class="btn" @click="saveDeck">Добавить</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "NewDeckComponent",
    data() {
        return {
            title: '',
        }
    },

    methods: {
        close(){
            this.$emit('close')
        },

        saveDeck(){
            axios
                .post('/api/new_deck', {title: this.title})

            this.$emit('added')
        }
    },
}
</script>
