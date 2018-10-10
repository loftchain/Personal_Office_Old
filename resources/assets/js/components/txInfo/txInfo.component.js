import axios from 'axios';
import ethers from 'ethers';

export default {
    name: 'tx-info',
    components: {},

    props: [],
    data() {
        return {
            adminTxData: [],
            currentSort: 'date',
            currentSortDir: 'desc',
            pageSize: 5,
            currentPage: 1,
            totalPages: 1,
            currencies: ['BTC', 'ETH'],
            checkedCurrency: ['BTC', 'ETH'],
            abi: [{"constant":true,"inputs":[],"name":"hasClosed","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"addBalanceForOraclize","outputs":[],"payable":true,"stateMutability":"payable","type":"function"},{"constant":false,"inputs":[{"name":"myid","type":"bytes32"},{"name":"result","type":"string"}],"name":"__callback","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_user","type":"address"}],"name":"delKYC","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"_owner","type":"address"}],"name":"isOwner","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"tokenPriceInWei","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"cap","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"myid","type":"bytes32"},{"name":"result","type":"string"},{"name":"proof","type":"bytes"}],"name":"__callback","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_user","type":"address"}],"name":"addKYC","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"weiRaised","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"closingTime","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"finalize","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"capReached","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"tokensSold","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"wallet","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"currentStage","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_url","type":"string"}],"name":"setOraclizeUrl","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[],"name":"updatePrice","outputs":[],"payable":true,"stateMutability":"payable","type":"function"},{"constant":false,"inputs":[{"name":"_price","type":"uint256"}],"name":"setTokenPrice","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_newOwner","type":"address"}],"name":"addOwner","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_owner","type":"address"}],"name":"delOwner","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_to","type":"address"}],"name":"withdrawBalance","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"","type":"uint256"}],"name":"stages","outputs":[{"name":"stopDay","type":"uint256"},{"name":"bonus1","type":"uint256"},{"name":"bonus2","type":"uint256"},{"name":"bonus3","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"","type":"bytes32"}],"name":"pendingQueries","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"isFinalized","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_stopDay","type":"uint256"},{"name":"_bonus1","type":"uint256"},{"name":"_bonus2","type":"uint256"},{"name":"_bonus3","type":"uint256"}],"name":"addStage","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"openingTime","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"reserveFund","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"","type":"address"}],"name":"KYC","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_newPrice","type":"uint256"}],"name":"setGasPrice","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"oraclizeBalance","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"oraclize_url","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_beneficiary","type":"address"}],"name":"buyTokens","outputs":[],"payable":true,"stateMutability":"payable","type":"function"},{"constant":false,"inputs":[{"name":"_beneficiary","type":"address"},{"name":"_tokens","type":"uint256"}],"name":"manualSale","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"stageCount","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"token","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"inputs":[{"name":"_wallet","type":"address"},{"name":"_token","type":"address"},{"name":"_cap","type":"uint256"},{"name":"_openingTime","type":"uint256"},{"name":"_closingTime","type":"uint256"},{"name":"_reserveFund","type":"address"},{"name":"_tokenPriceInWei","type":"uint256"}],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"payable":true,"stateMutability":"payable","type":"fallback"},{"anonymous":false,"inputs":[{"indexed":true,"name":"purchaser","type":"address"},{"indexed":true,"name":"beneficiary","type":"address"},{"indexed":false,"name":"value","type":"uint256"},{"indexed":false,"name":"tokens","type":"uint256"},{"indexed":false,"name":"bonus","type":"uint256"}],"name":"TokenPurchase","type":"event"},{"anonymous":false,"inputs":[],"name":"Finalized","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"description","type":"string"}],"name":"NewOraclizeQuery","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"price","type":"string"}],"name":"NewKrakenPriceTicker","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"newOwner","type":"address"}],"name":"OwnerAdded","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"owner","type":"address"}],"name":"OwnerDeleted","type":"event"}],
            crowdSaleAddress: process.env.MIX_HOME_WALLET_ETH,
            overrideOptions: { gasLimit: 150000 },
            provider: new ethers.providers.Web3Provider(web3.currentProvider, ethers.providers.networks.homestead),
        }
    },
    created() {
        this.loadTransactions();
    },

    mounted() {

    },

    computed: {
        sortedItems () {
            return this.adminTxData.sort((a, b) => {
                let modifier = 1;
                if (this.currentSortDir === 'desc') modifier = -1;
                if (a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
                if (a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
                return 0;
            }).filter((row, item) => {
                let start = (this.currentPage - 1) * this.pageSize;
                let end = this.currentPage * this.pageSize;
                if (item >= start && item < end) return true;
            }).filter(i => this.checkedCurrency.includes(i.currency));
        },
    },

    methods: {
        loadTransactions() {
            axios.get('/getDataForAdminTx')
                .then(res => {
                    this.countWhiteListBonus(res.data);
                    this.totalPages = res.data.length  // get quantity of transactions
                })
        },

        countWhiteListBonus(array) {
            for (let ar of array) {
                ar.white_list_bonus = (ar.email !== null) ? (ar.amount_tokens * 0.3).toFixed(2) : 'not in white-list';
                ar.refs_bonus = (ar.referred_by !== null) ? (ar.amount_tokens * 0.03).toFixed(2) : 'no refs bonus';
            }
           this.adminTxData = array;
        },

        sort: function (s) {
            if (s === this.currentSort) {
                this.currentSortDir = this.currentSortDir === 'asc' ? 'desc' : 'asc';
            }
            this.currentSort = s;
        },

        nextPage: function () {
            if ((this.currentPage * this.pageSize) < this.adminTxData.length) this.currentPage++;
        },

        prevPage: function () {
            if (this.currentPage > 1) this.currentPage--;
        },

        checkBoxClick: function () {
            this.pageSize = this.totalPages;
        },

        sendTokens(item) {
            switch (this.showButtonCondition(item)[1]) {
                case 'white-list bonus' :
                    this.sendTokensProccess(item, item.white_list_bonus);
                    break;
                case 'for BTC investment' :
                    this.sendTokensProccess(item, item.amount_tokens);
                    break;
                case 'for referral link' :
                    this.sendTokensProccess(item, item.refs_bonus);
                    break;
            }

        },

        sendTokensProccess(item, tokens) {
            let beneficiary = item.to ? item.to : item.from;
            let provider = new ethers.providers.Web3Provider(web3.currentProvider, ethers.providers.networks.homestead);
            let contract = new ethers.Contract(this.crowdSaleAddress, this.abi, this.provider.getSigner());
            let overrideOptions = {
                gasLimit: 150000
            };
            contract.manualSale(beneficiary, ethers.utils.parseEther(tokens), overrideOptions).then(tx => {
                alert('submitted');
                provider.waitForTransaction(tx.hash).then(tx => {
                    alert('confirmed');
                    this.updateTransaction(item.transaction_id, 'bonus_send');
                })
            })
        },

        showButtonCondition: function (item) {
            if (item.white_list_bonus !== 'not in white-list' && item.bonus_send !== 'true' && item.white_list_bonus !== '0.00') {
                return [true, 'white-list bonus'];
            } else if (item.send !== 'true' && item.info === 'blockchain.info') {
                return [true, 'for BTC investment'];
            } else if (item.refs_send === 'false' && item.refs_bonus !== 'no refs bonus' && item.refs_bonus !== '0.00') {
                return [true, 'for referral link'];
            } else {
                return [false,''];
            }
        },

        //Update the status of the transaction if it was successfully sent
        async updateTransaction(transactionId, action) {
            let response = await axios.post(`admin/transaction/update`, {
                id: transactionId,
                action: action
            });

            return response.data;
        }
    }
}
