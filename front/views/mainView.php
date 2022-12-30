<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>gila Notification Test</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
 </head>
 <body>
<div class="container">
    <h1 class="page-header text-center">
        <img src="assets/img/logo.jpg" />
    </h1>
    <div id="vueregapp">
        <div class="col-md-4">
  
            <div class="panel panel-primary">
                <div class="panel-heading"> Notification Form</div>
                <div class="panel-body">
                    <label>Category:</label>
                    <select class="form-control" ref="messageType" v-model="regDetails.messageType">
                        <option disabled value="">Please Select</option>
                        <option>Sports</option>
                        <option>Finance</option>
                        <option>Movies</option>
                    </select>
                    <div class="alert alert-danger text-center" v-if="errorFieldCategory" style="margin-top: 10px;">
                        <span style="font-size:13px;">{{ errorFieldCategory }}</span>
                    </div>
                    <br>
                    <label>Message:</label>
                    <textarea rows="3" class="form-control" ref="message" v-model="regDetails.message"></textarea>
                    <div class="alert alert-danger text-center" v-if="errorFieldMessage" style="margin-top: 10px;">
                        <span style="font-size:13px;">{{ errorFieldMessage }}</span>
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-primary btn-block" @click="notificationReg();"> Send</button>
                </div>
            </div>
  
            <div class="alert alert-danger text-center" v-if="errorMessage">
                <button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">×</span></button>
                {{ errorMessage }}
            </div>
  
            <div class="alert alert-success text-center" v-if="successMessage">
                <button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">×</span></button>
                {{ successMessage }}
            </div>

            <h4>
                <button class="btn btn-info btn-block" v-on:click="usersIsHidden = !usersIsHidden">Toggle Users Mockup</button>
            </h4>
            <div v-if="!usersIsHidden">
                <pre v-for="user in users">
                    {{ user }}
                </pre>
            </div>
  
        </div>
  
        <div class="col-md-8">
            <h3>Log History <button type="button" class="btn btn-danger" @click="deleteAllNotifications();"> delete logs </button></h3>
            <table class="table table-bordered table-striped">
                <thead>
                    <th>Notification ID</th>
                    <th>Message</th>
                    <th>User Data</th>
                    <th>Created</th>
                </thead>
                <tbody>
                    <tr v-for="log in logs">
                        <td style="text-align: right;">{{ log.id }}</td>
                        <td>
                            Category: <b>{{ log.messageType }}</b><br>
                            Notification Type: <b>{{ log.notificationType }}</b><br>
                            Message: <b>{{ log.message }}</b>
                        </td>
                        <td>
                            ID: <b>{{ log.userID }}</b><br>
                            Name: <b>{{ log.userName }}</b><br>
                            E-mail: <b>{{ log.userEmail }}</b><br>
                            Phone Number: <b>{{ log.userPhoneNumber }}</b>
                        </td>
                        <td style="text-align: center;">
                            {{ log.created  }}<br>
                            Status: <span v-if="log.sent == 1" style="color: green; font-weight: bold;">Sent</span>
                            <span v-if="log.sent == 0" style="color: red; font-weight: bold;">Failed</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="assets/js/vuejs.js"></script>
</body>
</html>