<template>
    <div class="search_map">
        <div class="main_profile_container">
        <div class="payment_wrapper" :style="{ height: profileHeight + 'px' }">

            <div v-if="!addCard" class="list-group">
                <a href="javascript:;" @click="cardEdit(c)" v-for="c in cards" class="list-group-item">
                    <h4 class="list-group-item-heading">{{ c.name }}</h4>
                    <p class="list-group-item-text"> {{ c.address }}</p>
                </a>
            </div>
            <payment-card-form v-else></payment-card-form>
            <button type="button" @click="addCard=!addCard">Add More</button>
        </div>

        </div>
    </div>

</template>

<script>
    import User from '../user';

    export default {
        props: ['profileHeight'],

        data() {
            return {
                cards: '',
                User: User,
                editCard: false,
                addCard: false,
            };
        },

        mounted() {
            let $scope = this;
            axios.get('/api/credit-card').then(function (r) {
                $scope.cards=r.data.success;
            });
        },

        methods: {
            cardEdit(c){

            }
        }
    }
</script>
