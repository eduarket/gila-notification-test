var app = new Vue({
    el: '#vueregapp',
    data: {
        successMessage: "",
        errorMessage: "",
        errorFieldCategory: "",
        errorFieldMessage: "",
        logs: [],
        users: [],
        usersIsHidden: true,
        regDetails: {messageType: '', message: ''},
    },
  
    mounted: function() {
        this.getMockupUsers();
        this.getAllNotifications();
    },
  
    methods: {
        getMockupUsers: function() {
            axios.get('http://localhost:1112/user/read.php')
                .then(function(response) {
                    app.users = response.data.records;
                });
        },

        getAllNotifications: function() {
            axios.get('http://localhost:1112/notification/read.php')
                .then(function(response) {
                    if(response.data.message) {
                        app.errorMessage = response.data.message;
                    } else {
                        app.logs = response.data.records;
                    }
                });
        },
  
        notificationReg: function() {
            if(!app.regDetails.messageType) {
                app.errorFieldCategory = 'Category is required.';
                app.focusCategory();
                return;
            } else {
                app.errorFieldCategory = '';
            }
            if(!app.regDetails.message) {
                app.errorFieldMessage = 'Message is required.';
                app.focusMessage();
                return;
            } else {
                app.errorFieldMessage = '';
            }
            var regForm = app.toFormData(app.regDetails);
            axios.post('http://localhost:1112/notification/create.php', regForm)
                .then(function(response) {
                    if(response.data.error) {
                        app.errorMessage = response.data.error;
                        app.successMessage = '';
                    } else {
                        app.errorMessage = '';
                        app.successMessage = response.data.message;
                        app.regDetails = {messageType: '', message:''};
                        app.getAllNotifications();
                    }
                });
        },

        deleteAllNotifications: function() {
            if(confirm("Do you really want to delete all logs?")) {
                axios.delete('http://localhost:1112/notification/deleteAll.php')
                    .then(() => {
                        this.clearMessage();
                        app.logs = [];
                        app.getAllNotifications();
                    });
            }
        },

        focusCategory: function() {
            this.$refs.messageType.focus();
        },
  
        focusMessage: function() {
            this.$refs.message.focus();
        },
  
        toFormData: function(obj) {
            var form_data = new FormData();
            for(var key in obj){
                form_data.append(key, obj[key]);
            }
            return form_data;
        },

        clearMessage: function() {
            app.errorMessage = '';
            app.successMessage = '';
        },
  
    }
});