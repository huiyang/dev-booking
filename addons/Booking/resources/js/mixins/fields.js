export default {
    computed: {
        fields() {
            return [
                {
                    name: 'Start Date Time',
                    handle: 'starts_at',
                    type: {
                        id: 'datetime',
                    },
                    settings: {
                        placeholder: 'From',
                        format:"Y-m-d H:i:s",
                        adjust_date: false,
                        time: true,
                    },
                },
                {
                    name: 'End Date Time',
                    handle: 'ends_at',
                    type: {
                        id: 'datetime',
                    },
                    settings: {
                        placeholder: 'To',
                        format:"Y-m-d H:i:s",
                        adjust_date: false,
                        time: true,
                    },
                },
            ]
        }
    }
}