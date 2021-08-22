<template>
    <div class="form">
        <div class="form-body" v-click-outside="close">
            <h2 class="form-title">Добавить колоду</h2>
            <div class="form__group">
                <label for="title" class="label form__group-label">Добавить карты</label>
                <input type="file" id="title" class="input form__group-input" ref="files" @change="changeFile" multiple accept="image/*">
            </div>
            <button class="btn" @click="uploadFiles">Добавить</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "NewDeckComponent",
    data() {
        return {
            files: 0,
        }
    },

    props: [
        'deckId'
    ],

    methods: {
        close(){
            this.$emit('close')
        },

        changeFile(){
            this.files = this.$refs.files.files
        },

        uploadFiles() {
            let formData = new FormData()
            for (let i = 0; i < this.files.length; i++) {
                let file = this.files[i]
                formData.append('files[' + i + ']', file)
            }

            formData.append('decksId', this.deckId)
            axios
                .post('/api/upload_cards',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                )
                .then(()=>this.close())
        }
    },
}
</script>
