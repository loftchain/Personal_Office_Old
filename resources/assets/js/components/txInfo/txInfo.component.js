import axios
    from 'axios';

export default {
    name: 'tx-info',
    components: {},
    props: [],
    data() {
        return {
            adminTxData: [],
            currentSort:'date',
            currentSortDir:'desc'
        }
    },
    created() {
        this.loadTransactions();
    },

    mounted() {

    },
    computed: {
        sortedItems:function() {
            return this.adminTxData.sort((a,b) => {
                let modifier = 1;
                if(this.currentSortDir === 'desc') modifier = -1;
                if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
                if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
                return 0;
            });
        }
    },

    methods: {
        loadTransactions() {
            axios.get('/getDataForAdminTx')
                .then(res => {
                    this.countWhiteListBonus(res.data);
                })
        },

        countWhiteListBonus(array) {
            for (let ar of array) {
                ar.white_list_bonus = (ar.email !== null) ? (ar.amount_tokens * 0.3).toFixed(2) : 'not in white-list';
                this.adminTxData = array;
            }
        },

        sort:function(s) {
            if(s === this.currentSort) {
                this.currentSortDir = this.currentSortDir === 'asc' ? 'desc' : 'asc';
            }
            this.currentSort = s;
        }
    }
}
