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

            <button class="primary-button" type="button" @click="cardAdd">{{ addCard?'Cancle':'Add Card' }}</button>

            <div class="add_bank_account">
                <h2>My account</h2>
<transition name="flip" mode="out-in">
   <div key="edit" v-if="viewAccount">
      <div v-if="editMenu">
         <label>
            <button class="danger" @click="removeAccount" data-loading-text="deleting ...">
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15" class="svg-icon">
                  <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#delete_icon"></use>
               </svg>
               remove
            </button>
         </label>
         <label>
            <button class="primary" @click="viewAccount = false">
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 20" class="svg-icon">
                  <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#edit_icon"></use>
               </svg>
               edit
            </button>
         </label>
      </div>
      <label v-if="!editMenu">
      <button class="primary" @click="viewAccount = false"><i class="fa fa-plus fa-2x" style="display:block;"></i> add</button>
      </label>
   </div>
   <div key="save" v-else>
      <label>
         <button class="primary" @click="saveAccount" data-loading-text="saving ..." :disabled="$v.account.$invalid">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 20" class="svg-icon">
               <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#send"></use>
            </svg>
            save
         </button>
      </label>
      <label>
         <button class="primary" @click="closeForm">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 20" class="svg-icon">
               <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close_icon"></use>
            </svg>
            close
         </button>
      </label>
   </div>
</transition>
<div :class="{card_recured_text:viewAccount, card_recured:!viewAccount}">
   <ul>
      <li>
         <div class="input-group login-input">
            <div class="input-group-addon">
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                  <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
               </svg>
            </div>
            <p v-if="viewAccount">Account holder name<span v-html="account.title"></span></p>
            <input v-else type="text" class="form-control" placeholder="Account holder name" v-model="account.title" @keyup="account.title = $event.target.value.toUpperCase()">
         </div>
      </li>
      <li>
         <div class="input-group login-input">
            <div class="input-group-addon">
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 21" class="svg-icon">
                  <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#card_form"></use>
               </svg>
            </div>
            <p v-if="viewAccount">Account number<span v-html="account.number"></span></p>
            <input v-else type="text" class="form-control" placeholder="Account number" v-model="account.number">
         </div>
      </li>
      <li>
         <div class="input-group login-input">
            <div class="input-group-addon">
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                  <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
               </svg>
            </div>
            <p v-if="viewAccount">Sort code<span v-html="account.sortcode"></span></p>
            <input v-else type="text" class="form-control" placeholder="Sort code" v-model="account.sortcode">
         </div>
      </li>
      <li>
         <div class="input-group login-input">
            <div class="input-group-addon">
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon" style="height:30px">
                  <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lcotion_icon"></use>
               </svg>
            </div>
            <p v-if="viewAccount">Billing address<span v-html="account.address"></span></p>
            <input v-else type="text" class="form-control" placeholder="Billing address" v-model="account.address">
         </div>
      </li>
   </ul>
</div>
            </div>

        </div>

    </div>
</template>

<script>
    import User from '../user';
    import {AlphaSpaceValidator} from '../validators';
    import {required, numeric, between} from 'vuelidate/lib/validators';
    export default {
        data() {
            return {
                card: '',
                cards: '',
                editCard: false,
                addCard: false,
                viewAccount: true,
                editMenu: false,
                 account: {
                    title: null,
                    number: null,
                    sortcode: null,
                    address: null
                },
                clone: {
                    title: null,
                    number: null,
                    sortcode: null,
                    address: null
                }
            };
        },

  validations: {
            withdraw: {
                required,
                numeric,
                between: between(1, 5000)
            },
            account: {
                title: {
                    required,
                    AlphaSpaceValidator
                },
                number: {
                    required,
                    numeric
                },
                sortcode: {
                    required,
                    numeric
                },
                address: {}
            }
        },

        mounted() {
            let $scope = this;
            axios.get('/api/credit-card').then(function (r) {
                $scope.cards = r.data.success;
            });
            _.each(User.state.auth.accounts, this.setAccountData);
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
            },
             setAccountData(v) {
                if (v.default) {
                    this.account = v;
                    this.editMenu = true;
                    this.clone = JSON.parse(JSON.stringify(v));
                }
            },
            saveAccount(e) {
                $('#sideLoader').show();
                let $btn = $(e.target).button('loading');

                axios[this.editMenu ? 'patch' : 'post']
                ('/api/account' + (this.editMenu ? '/' + this.account.id : ''), _.merge(this.account, {'default': 1}))
                    .then(this.processAccount)
                    .then(function () {
                        $btn.button('reset');
                    });
            },
              closeForm() {
                this.viewAccount = true;
                this.account = JSON.parse(JSON.stringify(this.clone));
            },
             processAccount(r) {
                this.editMenu = true;
                this.viewAccount = true;
                this.account = r.data.success;
                this.clone = JSON.parse(JSON.stringify(r.data.success));
                $('#sideLoader').hide();
            },
            removeAccount(e) {
                let $t = this;
                let $btn = $(e.target).button('loading');
                $('#sideLoader').show();
                axios.delete('/api/account/' + this.account.id).then(function () {
                    $btn.button('reset');
                    $t.account = {
                        title: null,
                        number: null,
                        sortcode: null,
                        address: null
                    };
                    $t.clone = JSON.parse(JSON.stringify($t.account));
                    $t.editMenu = false;
                    $('#sideLoader').hide();
                });
            },
        }
    }
</script>
