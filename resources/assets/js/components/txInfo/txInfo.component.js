import axios
    from 'axios';

export default {
    name: 'tx-info',
    components: {},
    props: [],
    data() {
        return {
            adminTxData: []
        }
    },
    created() {
        axios.get('/getDataForAdminTx')
            .then(res => {
                this.adminTxData = res;
                console.log(this.adminTxData);
            })
    },

    mounted() {

    },
    computed: {},

    methods: {}
}
