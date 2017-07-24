<template>
    <div key="card_detail">
        <div class="card_recured">
            <ul>
                <li>
                    <div class="form-group">
<div class="input-group login-input">
<div class="input-group-addon">                        
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                        </svg>
</div>
                        <input @keyup="card.name = $event.target.value.toUpperCase()" @blur="$v.card.name.$touch()" v-model.trim="card.name" type="text" class="form-control" placeholder="name on card" name="name">
</div>
                    </div>
                </li>
                <li>
                    <div class="form-group">
<div class="input-group login-input">
<div class="input-group-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 21" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#card_form"></use>
                        </svg>
</div>
                        <input @blur="$v.card.number.$touch()" v-model.trim="card.number" type="text" class="form-control cc-num" placeholder="card number" name="number">
</div>
                    </div>
                </li>
                <li>
                    <div class="form-group">
<div class="input-group login-input">
<div class="input-group-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                        </svg>
</div>
                        <input @blur="$v.card.expiry.$touch()" v-model.trim="card.expiry" type="text" class="form-control cc-exp" placeholder="card expira/on date" name="expiry">
</div>
                    </div>
                </li>
                <li>
                    <div class="form-group">
<div class="input-group login-input">
<div class="input-group-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 30" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#security_form_icon"></use>
                        </svg>
</div>
                        <input @blur="$v.card.cvc.$touch()" v-model.trim="card.cvc" type="password" class="form-control cc-cvc" placeholder="cvc" name="cvc">
</div>
                    </div>
                </li>
                <li>
                    <svg @click="card.terms = !card.terms" :class="{active: card.terms}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon cursor-pointer">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                    </svg>

                    <p>I have read and understood the</p>
                    <a href="/terms-and-conditions" target="_blank">Terms & Conditions</a>
                </li>
            </ul>
            <button @click="processCard" class="primary-button"> {{ editCard ? 'Update card' : 'Save card' }}</button>
        </div>
    </div>
</template>

<script>
    import User from '../user';
    import Local from '../local';
    import {Boolean} from '../validators';
    import {required, minLength} from 'vuelidate/lib/validators';
    export default {
        props: ['profileHeight','editCard','selectedcard'],

        data() {
            return {
                cards: '',
                User: User,
                credit_cards: null,
                card: {
                    id: '',
                    name: '',
                    number: '',
                    expiry: '',
                    cvc: '',
                    terms: false,
                }
            };
        },

        validations: {
            card: {
                name: {
                    required
                },
                number: {
                    required,
                    minLength: minLength(14)
                },
                expiry: {
                    required,
                    minLength: minLength(7)
                },
                cvc: {
                    required,
                    minLength: minLength(3)
                },
                terms: {
                    required,
                    Boolean
                },
            }
        },

        mounted() {
            let $scope = this;
            if(this.editCard)
                this.card =  this.selectedcard;
            else
                this.card =  {};

        },

        methods: {
            processCard(){

                if(!this.editCard){
                    axios.post('/api/credit-card', this.card)
                        .then(function (r) {
                            new Noty({
                                type: 'information',
                                text: 'Card added successfuly!',
                            }).show();
                        });
                } else {
                    axios.patch('/api/credit-card/'+this.selectedcard.id, this.card)
                        .then(function (r) {
                            new Noty({
                                type: 'information',
                                text: 'Card update successfuly!',
                            }).show();
                        });
                }

            }
        }
    }
</script>
