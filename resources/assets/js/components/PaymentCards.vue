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

                <payment-card-form :editCard="editCard" :selectedcard="card" key="add-cards" v-else></payment-card-form>
            </transition>

            <button class="primary-button" type="button" @click="cardAdd">{{ addCard?'Cancle':'Add more' }}</button>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                card: '',
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
                this.card=c;
                this.editCard=! this.editCard;
                this.addCard = !this.addCard;
            },
            cardAdd(){
                this.addCard = !this.addCard;
                this.editCard = false;
                this.card = {};
            }
        }
    }
</script>
