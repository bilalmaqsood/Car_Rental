<template>

    <section class="container">
        <div class="row">
            <div class="col-md-8">
                   <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ form.dateStart }} </label>
                                <flat-pickr :config="configs.rangePlugin" v-model="form.dateStart" @onChange="onChange"></flat-pickr>
                            </div>
                        </div>
                        <!--<div class="col-md-6">-->
                            <!--<div class="form-group">-->
                                <!--<label>To date</label>-->
                                <flat-pickr style="display: none;" :config="configs.rangePlugin" id="end-date" v-model="form.dateEnd"></flat-pickr>
                            <!--</div>-->
                        <!--</div>-->
                    </div>
            </div>
        </div>


    </section>
</template>

<script type="text/javascript">
    import flatPickr from 'vue-flatpickr-component';
    import 'flatpickr/dist/flatpickr.css';
//    import flatPickr from 'flatpickr/src/index';
    // Need to add base css for flatpickr
    // Plugins are optional
    // https://chmln.github.io/flatpickr/plugins/
    import ConfirmDatePlugin from 'flatpickr/dist/plugins/confirmDate/confirmDate';
    import 'flatpickr/dist/plugins/confirmDate/confirmDate.css';
    import rangePlugin from 'flatpickr/dist/plugins/rangePlugin';
    export default {
        name: 'app',
        data() {
            return {
                form: {
                    dateStart: "2017-10-10",
                    dateEnd: "2017-11-11"
                },
                configs: {
                    basic: {},
                    wrap: {
                        wrap: true,
                        altFormat: 'M	j, Y',
                        altInput: true,
                        dateFormat: "Y-m-d",
                    },
                    timePicker: {
                        wrap: true,
                        enableTime: true,
                        enableSeconds: true,
                        noCalendar: true
                    },
                    dateTimePicker: {
                        enableTime: true,
                        dateFormat: 'd-m-Y H:i'
                    },
                    locale: {
                        // https://chmln.github.io/flatpickr/localization/

                        // https://chmln.github.io/flatpickr/events/
                        onChange: this.onChange
                    },
                    inline: {
                        inline: true
                    },
                    confirmPlugin: {
                        enableTime: true,
                        plugins: [new ConfirmDatePlugin({confirmText: 'Done'})]
                    },
                    rangePlugin: {
                        plugins: [new rangePlugin({input: "#end-date"})],
                        minDate: "today",
                        altInput: true,
                        inline: true,
                    }
                },
            }
        },
        components: {
            flatPickr
        },
        methods: {
            setNewDate() {
                console.log('Set new date');
                this.form.dateBasic = '2018-12-01';
            },
            updateConfig() {
                console.log('Update config');
                // Right way to modify config runtime
                // https://vuejs.org/v2/api/#Vue-set
                this.$set(this.configs.basic, 'mode', 'range');
            },
            changeTheme() {
                require('flatpickr/dist/themes/material_blue.css');
            },
            onChange(selectedDates, dateStr, instance) {
                console.log('Date change hook was called', dateStr);
            },
            listenToOnChangeEvent(selectedDates, dateStr, instance) {
                console.log('listen To OnChange Event', dateStr);
            },
            submit() {
                console.log('Form submit event');
                console.log(this.form);
                // http://vee-validate.logaretm.com/examples.html#component-example
                this.$validator.validateAll().then(result => {
                    // eslint-disable-next-line
                    alert(`Form validation result: ${result}`);
                });
            }
        },
        mounted() {
//            let flatPickrInstance = this.$refs.datePickerWrap.fp;
            // Do something with instance
            // https://chmln.github.io/flatpickr/instance-methods-properties-elements/
//            console.log(flatPickrInstance)
        }
    }
</script>