<template>
    <div class="dropdown">
        <span class="dropdown-value" @click="switchOpen">{{ value }} <img src="/img/dd.svg" alt="dropdown-arrow" class="dropdown-icon"></span>
        <ul class="dropdown__list" v-if="open === 1">
            <li class="dropdown__list-item" v-for="option in options" @click="returnValue(option)">{{ option }}</li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "DropDownComponent",
    props: [
        'options'
    ],
    data() {
        return {
            value: 'Выберите параметр...',
            open: 0
        }
    },
    methods: {
        returnValue(option){
            this.$emit('getOption',{
                option: option
            })

            this.open = 0
            this.value = option
        },

        switchOpen(){
            if (this.open === 0){
                this.open = 1
            } else {
                this.open = 0
            }
        }
    }
}
</script>
