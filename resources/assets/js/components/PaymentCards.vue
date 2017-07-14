<template>
    <div class="main_profile_container">

        <div class="payment_wrapper">
            <transition name="flip" mode="out-in">
                <div v-if="!addCard" class="list-group m-0" key="list-cards">
                    <a href="javascript:" @click="cardEdit(c)" v-for="c in cards" class="list-group-item">
                        <h4 class="list-group-item-heading">{{ c.name }}</h4>
                        <p class="list-group-item-text"> {{ c.address }}</p>
                    </a>
                </div>

                <payment-card-form key="add-cards" v-else></payment-card-form>
            </transition>

            <button type="button" @click="addCard=!addCard">Add More</button>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                cards: '',
                editCard: false,
                addCard: false,
            };
        },

        mounted() {
            let $scope = this;
            axios.get('/api/credit-card').then(function (r) {
                $scope.cards = r.data.success;
            });
        },

        methods: {
            cardEdit(c) {
            }
        }
    }
</script>
