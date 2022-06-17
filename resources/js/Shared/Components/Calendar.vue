<template>
    <div class="p-3 rounded bg-white">
        <FullCalendar :options="calendarOptions" ></FullCalendar>
    </div>
</template>

<script>

import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'

export default {
    name: "Calendar",
    data() {
        return {
            calendarOptions: {
                plugins: [ dayGridPlugin, interactionPlugin ],
                initialView: 'dayGridMonth',
                events: this.events,
                eventClick: this.handleItemClick,
                dateClick: this.handleDateClick,
                datesSet: this.handleMonthChange,
                locale: 'fr' ,
                firstDay: 1,
                height: 700,
                displayEventTime: false,
            }
        }
    },
    components: {
        FullCalendar // make the <FullCalendar> tag available
    },
    props: {
        events: {
            type: Array,
            default: []
        },
    },
    methods: {
        handleItemClick: function(arg) {
            this.$emit('eventClick', arg)
            // alert('ITEM click! ' + arg.dateStr)
        },

        handleDateClick: function(arg) {
            this.$emit('dateClick', arg);
            //console.log(arg);
            // alert('ITEM click! ' + arg.dateStr)
        },

        handleMonthChange: function(payload) {
            this.$emit('changeMonthClick', payload)
        }

    },
}
</script>

<style scoped>

</style>
