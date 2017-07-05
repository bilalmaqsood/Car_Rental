<template>
    <div>
        <div class="user-want-container">
            <div class="user_type_selection text-left user-want-rent">
                <div class="btn-group" data-toggle="buttons" style="padding-top: 1rem">
                    <label class="btn btn-primary">
                        <input name="type" autocomplete="off" type="radio"> I want to rent
                    </label>
                    <label class="btn btn-primary">
                        <input name="type" autocomplete="off" type="radio"> I own a car
                    </label>
                </div>
            </div>
            <div class="user_type_selection text-left user-rent-btn">
                <button class="primary_btn" @click="changeView">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                    </svg>
                    login
                </button>
                <button class="secodery_btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                    </svg>
                    done
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {};
        },

        mounted() {
            this.prepareComponent();
        },

        methods: {
            prepareComponent() {
                console.log('register componenet mounted');
            },

            changeView() {
                this.$emit('updateView');
            }
        }
    }
</script>
