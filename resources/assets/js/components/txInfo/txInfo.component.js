import axios from 'axios';

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
        this.loadTransactions();
    },

    mounted() {

    },
    computed: {},

    methods: {
        loadTransactions(){
            axios.get('/getDataForAdminTx')
                .then(res => {
                    this.adminTxData = res.data;
                    console.log(this.adminTxData);
                })
        }
    }
}
