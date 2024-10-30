jQuery( function( $ ) {
    krokedilWidgetSettings = {
        placementSelector: 'select[data-krokedil-placement="1"]',
        inputFieldSelector: 'input.krokedil-shop-widget-custom-placement',
        hiddenClass: 'krokedil-shop-widget-hidden',

        init: function() {
            // On change for a placementSelector.
            $( document.body ).on( 'change', krokedilWidgetSettings.placementSelector, (e) => krokedilWidgetSettings.onPlacementSelectorChanged(e));

            // Trigger change event on load. This ensures that the display is correct on load.
            $( krokedilWidgetSettings.placementSelector ).trigger( 'change' );
        },

        onPlacementSelectorChanged: function( event ) {
            const placement = $( event.target ).val();
            const settingKey = $( event.target ).data( 'krokedil-setting-key' );

            if ( placement === 'custom' ) {
                krokedilWidgetSettings.showCustomPlacementInputs(settingKey);
            } else {
                krokedilWidgetSettings.hideCustomPlacementInputs(settingKey);
            }
        },

        hideCustomPlacementInputs: function(settingKey) {
            $( krokedilWidgetSettings.inputFieldSelector + '[data-krokedil-setting-key="' + settingKey + '"]' ).addClass( krokedilWidgetSettings.hiddenClass );
        },

        showCustomPlacementInputs: function(settingKey) {
            $( krokedilWidgetSettings.inputFieldSelector + '[data-krokedil-setting-key="' + settingKey + '"]' ).removeClass( krokedilWidgetSettings.hiddenClass );
        }
    }

    krokedilWidgetSettings.init();
});
