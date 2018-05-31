import axios
    from 'axios';

export default {
    name: 'tx-info',
    components: {},
    props: [],
    data() {
        return {
            adminTxData: [],
        }
    },
    created() {
        this.loadTransactions();
    },

    mounted() {

    },
    computed: {},

    methods: {
        loadTransactions() {
            axios.get('/getDataForAdminTx')
                .then(res => {
                    this.countWhiteListBonus(res.data);
                    console.log(this.adminTxData);
                })
        },

        countWhiteListBonus(array) {
            for (let ar of array) {
                ar.white_list_bonus = (ar.email !== null) ? (ar.amount_tokens * 0.3).toFixed(2) : 'not in white-list';
                this.adminTxData = array;
            }
        }
    }
}
