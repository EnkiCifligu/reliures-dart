class tdEventBus {

    constructor() {
        //registered events
        this.registeredEvents = {};

        this.listen();
    }


    /**
     * Listen for clicks on theme panel main menu
     */
    listen() {
        let evBus = this;

        jQuery('.td-panel-menu > li > a').on('click', function(event) {
            let button = jQuery(event.target);

            for (let eventName in evBus.registeredEvents) {
                if (evBus.registeredEvents.hasOwnProperty(eventName) && button.data('panel') === eventName) {
                    evBus.emit(eventName, button);
                }
            }
        });

    }


    /**
     * Register events
     * Can register multiple events under one name
     * @param eventName
     * @param callback
     * @param componentObj
     * @param runOnce
     */
    on(eventName, callback, componentObj, runOnce) {
        if (this.registeredEvents[eventName] === undefined) {
            this.registeredEvents[eventName] = [];
        }

        let event = {
            callback: callback,
            componentObj: componentObj,
            runOnce: false
        };

        if (runOnce !== undefined && runOnce === true) {
            event['runOnce'] = true;
        }

        this.registeredEvents[eventName].push(event);
    }


    /**
     * Trigger callback on registered events
     * @param eventName
     * @param data - (optional) data passed to the event callback
     */
    emit(eventName, data) {
        if (this.registeredEvents[eventName] !== undefined) {
            let event = this.registeredEvents[eventName];

            for (let i = 0; i < event.length; i++) {
                event[i].callback.apply(event.componentObj, data);

                if (event[i].runOnce === true) {
                    //remove events set to run once
                    event.splice(i, 1);
                }
            }

            if (event.length === 0) {
                //remove empty eventName's
                delete this.registeredEvents[eventName];
            }

        }
    }

}

var tdPanelEventBus = new tdEventBus();