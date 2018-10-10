import axios from 'axios';

export default {
    name: "kyc",

    data() {
        return {
            users: null,
            currentUrl: window.location.origin,
            currentSort:'date',
            currentSortDir:'desc',
            pageSize:5,
            currentPage:1,
            totalPages:1,
        }
    },

    created() {
        this.getPersonals();

    },

    computed: {
        sortedItems:function() {
            if(this.users !== null){
                return this.users.sort((a,b) => {
                    let modifier = 1;
                    if(this.currentSortDir === 'desc') modifier = -1;
                    if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
                    if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
                    return 0;
                }).filter((row, index) => {
                    let start = (this.currentPage-1)*this.pageSize;
                    let end = this.currentPage*this.pageSize;
                    if(index >= start && index < end) return true;
                });
            }
        },
    },

    methods: {
        getPersonals() {
            axios.get('/admin/kyc')
                .then(res => {
                    if(res.data){
                        this.users = res.data;
                        this.totalPages = res.data.length;
                    }
                })
        },

        sort:function(s) {
            if(s === this.currentSort) {
                this.currentSortDir = this.currentSortDir === 'asc' ? 'desc' : 'asc';
            }
            this.currentSort = s;
        },

        nextPage:function() {
            if((this.currentPage*this.pageSize) < this.users.length) this.currentPage++;
        },

        prevPage:function() {
            if(this.currentPage > 1) this.currentPage--;
        },
    },
}