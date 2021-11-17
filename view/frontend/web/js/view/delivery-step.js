define(
    [
        'jquery',
        'ko',
        'uiComponent',
        'underscore',
        'Magento_Checkout/js/model/step-navigator',
        'Magento_Checkout/js/model/quote',
        'mage/url',
        'mage/storage'
    ],
    function (
        $,
        ko,
        Component,
        _,
        stepNavigator,
        quote,
        urlBuilder,
        storage
    ) {
        'use strict';
        /**
        * delivery - is the name of the component's .html template
        * AHT_CustomCheckout - is the name of your module directory.
        */
        return Component.extend({
            defaults: {
                template: 'AHT_CustomCheckout/delivery'
            },

            //add here your logic to display step,
            isVisible: ko.observable(true),
            //step code will be used as step content id in the component template
            stepCode: 'delivery', /* correspond html file name in sibling template folder */
            //step title value
            stepTitle: 'Delivery step',

            /**
            * @returns {*}
            */
            initialize: function () {
                this._super();
                // register your step
                stepNavigator.registerStep(
                    // step code will be used as step content id in the component template
                    this.stepCode,
                    //step alias
                    null,
                    // step title value
                    this.stepTitle,
                    //observable property with logic when display step or hide step
                    this.isVisible,

                    _.bind(this.navigate, this),

                    /**
                    * sort order value
                    * 'sort order value' < 10: step displays before shipping step;
                    * 10 < 'sort order value' < 20 : step displays between shipping and payment step
                    * 'sort order value' > 20 : step displays after payment step
                    */
                    15
                );

                return this;
            },

            /**
            * The navigate() method is responsible for navigation between checkout step
            * during checkout. You can add custom logic, for example some conditions
            * for switching to your custom step
            */
            navigate: function () {
                // show custom step content when user navigates via url anchor or back button
                this.isVisible(true);
            },

            /**
            * Sent form data when click next
            * 
            * @returns void
            */
            navigateToNextStep: function () {
                // get date value
                var date = $("input[name=date]").val();
                // get comment value
                var comment = $("#delivery-comment").val();
                // get current quote id
                var quoteId = quote.getQuoteId();
                // controller url to send data
                var url = urlBuilder.build('delivery/index/savequote');
                storage.post(
                    url,
                    JSON.stringify({ quoteId: quoteId, date: date, comment: comment }), // send data as JSON
                    false
                ).done(
                    function () {
                        stepNavigator.next();
                    }
                ).fail();
            }
        });
    }
);