// Send a POST request
export default {
    data() {
        return {

        }
    },
    methods: {
        async callApi(method, url, data, response, headers) {
            try {
                return await axios({
                    method: method,
                    url: url,
                    data: data,
                    responseType: response,
                    readers: headers
                });
            } catch (e) {
                return e.response;
            }
        },
        // makeToast(tittle, text, variant = null) {
        //     this.toastCount++
        //     this.$bvToast.toast(text, {
        //         title: tittle,
        //         autoHideDelay: 2000,
        //         variant: variant,
        //         solid: true
        //         // appendToast: append
        //     })
        // }
    },
}
