<template>
    <div class="main_profile_container" v-bind:style="{'min-height': viewHeight+'px'}">

        <div class="payment_wrapper">
            <h2 style="float: none; clear: both;">My Cards</h2>
            <transition name="flip" mode="out-in">
                <div v-if="!addCard" class="list-group m-0" key="list-cards">
                  <div  v-for="c in cards" >
                    <a href="javascript:" @click="cardEdit(c)" class="list-group-item col-sm-11">
                        <h4 class="list-group-item-heading">{{ c.name }}</h4>
                        <p class="list-group-item-text"> {{ c.address }}</p>
                    </a>
                    <a class="btn btn-danger pull-right col-sm-1" @click="removeCard(c)"><i class="fa fa-trash"></i></a>
                  </div>
                </div>
            </transition>

            <transition name="flip" mode="out-in">
                <payment-card-form  @changeView="handleForm" v-if="addCard" :editCard="editCard" :selectedcard="card" key="add-cards"></payment-card-form>
            </transition>

            <button class="primary-button" type="button" @click="cardAdd">{{ addCard?'Cancel':'Add Card' }}</button>
           
            
        </div>

    </div>
</template>

<script>
    import User from '../user';
    import {AlphaSpaceValidator} from '../validators';
    import {required, numeric, between} from 'vuelidate/lib/validators';
    export default {
      props: ["viewHeight"],
        data() {
            return {
                User: User,
                card: '',
                cards: [],
                withdraw: '',
                editCard: false,
                addCard: false,
                viewAccount: true,
                editMenu: false,
                earningView: false,
                total_balance: false,
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
            axios.get('/api/current-balance').then(this.processEarnings);
            _.each(User.state.auth.accounts, this.setAccountData);
        },

        methods: {
            processEarnings(r) {
                this.total_balance = r.data.success;
                this.earningView = true;
                $('#sideLoader').hide();
            },
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
                let account = _.merge(this.account, {'default': 1});
                console.log(account);
                axios[this.editMenu ? 'patch' : 'post']
                ('/api/account' + (this.editMenu ? '/' + this.account.id : ''), account)
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
            withdrawAmount(e) {
                $('#sideLoader').show();

                let $t = this;
                let $btn = $(e.target).button('loading');

                axios.post('/api/withdraw', {
                    amount: this.withdraw
                }).then(function (r) {
                    $('#sideLoader').hide();
                    $btn.button('reset');
                    $t.prepareComponent();
                });
            },
            handleForm(data=null){
              if(data !== null){
                this.cards.push(data);
              }

              let logged_booking = localStorage.getItem('overdue_item');
              let $this = this;
            
            if(logged_booking) //payment here
                this.processOverDuePayment(JSON.parse(logged_booking).id);

              if(User.state.oldView)
                 setTimeout(function() {
                     $this.$parent.$emit("oldMenuView",User.state.oldView);
                }, 500);
               this.addCard = !this.addCard;
            },
            removeCard(c){
              let $this=this;
              var n = new Noty({
                  text: '<b>Do you want to continue?</b>',
                  timeout: false,
                  buttons: [
                    Noty.button('YES', 'btn btn-success', function () {
                      n.close();
                      setTimeout(function() { $this.processDestroy(c); }, 100);
                    
                    }, {id: 'button1', 'data-status': 'ok'}),

                    Noty.button('NO', 'btn btn-error', function () {
                        console.log('button 2 clicked');
                        n.close();
                    })
                  ]
                }).show();

              
            },
            processDestroy(c){


                 axios.delete('/api/credit-card/'+c.id).then((r)=>{
                  this.cards.splice(this.cards.indexOf(c), 1);

                          new Noty({
                                type: 'success',
                                text: r.data.success
                            }).show();
                  });
            },

            processOverDuePayment(booking_id){


            var n = new Noty({
                  text: '<b>Continue with the payment deposit?</b>',
                  timeout: false,
                  buttons: [
                    Noty.button('YES', 'btn btn-success', function () {
                      n.close();
                axios.post('/api/booking/' + booking_id+'/pay-overdue').then(r=>{
                    
                    new Noty({
                                type: 'success',
                                text: r.data.success
                            }).show();
                }).catch(r=>{
                    
                    new Noty({
                                type: 'danger',
                                text: r.response.data.error
                            }).show();
                }); 
                    
                    }, {id: 'button1', 'data-status': 'ok'}),

                    Noty.button('NO', 'btn btn-error', function () {
                        console.log('button 2 clicked');
                        n.close();
                    })
                  ]
                }).show();





            }
        }
    }
</script>
